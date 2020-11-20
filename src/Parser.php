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

    private ?string $yearOpenFlag = null;
    private ?string $yearCloseFlag = null;
    private ?string $monthOpenFlag = null;
    private ?string $monthCloseFlag = null;
    private ?string $dayOpenFlag = null;
    private ?string $dayCloseFlag = null;

    private ?string $tzSign = null;
    private ?int $tzMinute = null;
    private ?int $tzHour = null;
    private ?string $tzUtc = null;

    public function parse(string $data): object
    {
        $stringTypes = [
            'tzUtc',
            'tzSign',
            'yearOpenFlag',
            'yearCloseFlag',
            'monthOpenFlag',
            'monthCloseFlag',
            'dayOpenFlag',
            'dayCloseFlag'
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
        return $this;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function getYearOpenFlag(): ?string
    {
        return $this->yearOpenFlag;
    }

    public function getYearCloseFlag(): ?string
    {
        return $this->yearCloseFlag;
    }

    public function getMonthOpenFlag(): ?string
    {
        return $this->monthOpenFlag;
    }

    public function getMonthCloseFlag(): ?string
    {
        return $this->monthCloseFlag;
    }

    public function getDayOpenFlag(): ?string
    {
        return $this->dayOpenFlag;
    }

    public function getDayCloseFlag(): ?string
    {
        return $this->dayCloseFlag;
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