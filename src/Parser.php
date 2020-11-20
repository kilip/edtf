<?php

declare(strict_types = 1);

namespace EDTF;


class Parser
{
    private string $regexPattern = "/(?x) # Turns on free spacing mode for easier readability

					# Year start
						(?<year>
						    (?<yearOpenFlag>[~?%]{0,2})
							(?<yearNum>[+-]?(?:\d+e\d+|[0-9u][0-9ux]*))
							(?>S # Literal S letter. It is for the significant digit indicator
							(?<yearPrecision>\d+))?
							(?<yearCloseFlag>\)?[~%?]{0,2})
						)
					# Year end

					(?>- # Literal - (hyphen)

					# Month start
                        (?<month>
                            (?<monthOpenFlag>[~?%]{0,2})
                            (?<monthOpenParents>\(+)?
							(?<monthNum>
								(?>1[0-9u]|[0u][0-9u]|2[1-4])
							)
							(?>\^
								(?<seasonQualifier>[\P{L}\P{N}\P{M}:.-]+)
                            )?
                            (?<monthCloseFlag>[~?%]{0,2})
						)
					# Month end

					(?>- # Literal - (hyphen)

					# Day start
						(?<day>
						(?<dayOpenFlag>[~?%]{0,2})
						(?<dayOpenParents>\(+)?
						(?<dayNum>(?>[012u][0-9u]|3[01u])))
						(?<dayCloseFlag>[~?%]{0,2})
						(?<dayEnd>[)~%?]*)
					# Day end

					# Others start #
						(?>T # Literal T
						(?<hour>2[0-3]|[01][0-9]):
						(?<minute>[0-5][0-9]):
						(?<second>[0-5][0-9])
						(?>(?<tzUtc>Z)|
						(?<tzSign>[+-])
						(?<tzHour>[01][0-9]):
						(?<tzMinute>[0-5][0-9]))?)?)?)?$
					# Others end #
					/";

    private ?int $yearNum = null;
    private ?int $monthNum = null;
    private ?int $dayNum = null;
    private ?int $hour = null;
    private ?int $minute = null;
    private ?int $second = null;
    private ?int $season = null;

    private int $yearQualification = 0;
    private int $monthQualification = 0;
    private int $dayQualification = 0;

    private ?string $tzSign = null;
    private ?int $tzMinute = null;
    private ?int $tzHour = null;
    private ?string $tzUtc = null;

    private int $intervalType = 0;

    public function parse(string $data, bool $intervalMode = false): object
    {
        if($intervalMode && "" === $data){
            $this->intervalType = Interval::UNKNOWN;
            return $this;
        }

        if($intervalMode && ".." === $data) {
            $this->intervalType = Interval::OPEN;
            return $this;
        }

        $stringTypes = [
            'tzUtc',
            'tzSign',
        ];

        preg_match($this->regexPattern, $data, $matches);

        if("" !== $data && count($matches) <= 1){
            throw new \InvalidArgumentException(
                sprintf("invalid data %s", $data)
            );
        }

        foreach($matches as $name => $value){
            if(is_int($name) || $value === ""){
                continue;
            }
            if(!in_array($name, $stringTypes)){
                $value = (int) $value;
            }
            $this->$name = $value;
        }

        // convert month into season
        if($this->monthNum > 12){
            $this->monthNum = null;
            $this->season = (int)$matches['monthNum'];
        }

        $this->yearQualification = $this->configureQualification($matches, 'yearOpenFlag', 'yearCloseFlag');
        $this->monthQualification = $this->configureQualification($matches, 'monthOpenFlag', 'monthCloseFlag');
        $this->dayQualification = $this->configureQualification($matches, 'dayOpenFlag', 'dayCloseFlag');

        return $this;
    }

    private function configureQualification(array $matches, string $openFlag, string $closeFlag): int
    {
        if(isset($matches[$openFlag]) && $matches[$openFlag] !== ""){
            return $this->getQualificationValue((string)$matches[$openFlag]);
        }elseif(isset($matches[$closeFlag]) && $matches[$closeFlag] !== ""){
            return $this->getQualificationValue((string)$matches[$closeFlag]);
        }
        return Qualification::UNDEFINED;
    }

    private function getQualificationValue(string $value): int
    {
        if('?' === $value){
            return Qualification::UNCERTAIN;
        }elseif('~' === $value){
            return Qualification::APPROXIMATE;
        }elseif('%' === $value){
            return Qualification::UNCERTAIN_AND_APPROXIMATE;
        }
        throw new \InvalidArgumentException(sprintf(
            'Invalid qualification flag "%s".', $value
        ));
    }

    public function getIntervalType(): int
    {
        return $this->intervalType;
    }

    public function getYearQualification(): int
    {
        return $this->yearQualification;
    }

    public function getMonthQualification(): int
    {
        return $this->monthQualification;
    }

    public function getDayQualification(): int
    {
        return $this->dayQualification;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function getTzUtc(): ?string
    {
        return $this->tzUtc;
    }

    public function getYearNum(): ?int
    {
        return $this->yearNum;
    }

    public function getMonthNum(): ?int
    {
        return $this->monthNum;
    }

    public function getDayNum(): ?int
    {
        return $this->dayNum;
    }

    public function getHour(): ?int
    {
        return $this->hour;
    }

    public function getMinute(): ?int
    {
        return $this->minute;
    }

    public function getSecond(): ?int
    {
        return $this->second;
    }

    public function getTzSign(): ?string
    {
        return $this->tzSign;
    }

    public function getTzMinute(): ?int
    {
        return $this->tzMinute;
    }

    public function getTzHour(): ?int
    {
        return $this->tzHour;
    }
}