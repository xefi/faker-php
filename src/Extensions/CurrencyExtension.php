<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;

class CurrencyExtension extends Extension
{
    use HasLocale;

    protected array $currencies = [
        ['code' => 'AED', 'name' => 'United Arab Emirates Dirham', 'symbol' => 'د.إ'],
        ['code' => 'AFN', 'name' => 'Afghan Afghani', 'symbol' => '؋'],
        ['code' => 'ALL', 'name' => 'Albanian Lek', 'symbol' => 'L'],
        ['code' => 'AMD', 'name' => 'Armenian Dram', 'symbol' => '֏'],
        ['code' => 'ANG', 'name' => 'Netherlands Antillean Guilder', 'symbol' => 'ƒ'],
        ['code' => 'AOA', 'name' => 'Angolan Kwanza', 'symbol' => 'Kz'],
        ['code' => 'ARS', 'name' => 'Argentine Peso', 'symbol' => '$'],
        ['code' => 'AUD', 'name' => 'Australian Dollar', 'symbol' => 'A$'],
        ['code' => 'AWG', 'name' => 'Aruban Florin', 'symbol' => 'ƒ'],
        ['code' => 'AZN', 'name' => 'Azerbaijani Manat', 'symbol' => '₼'],
        ['code' => 'BAM', 'name' => 'Bosnia-Herzegovina Convertible Mark', 'symbol' => 'KM'],
        ['code' => 'BBD', 'name' => 'Barbadian Dollar', 'symbol' => 'Bds$'],
        ['code' => 'BDT', 'name' => 'Bangladeshi Taka', 'symbol' => '৳'],
        ['code' => 'BGN', 'name' => 'Bulgarian Lev', 'symbol' => 'лв'],
        ['code' => 'BHD', 'name' => 'Bahraini Dinar', 'symbol' => '.د.ب'],
        ['code' => 'BIF', 'name' => 'Burundian Franc', 'symbol' => 'FBu'],
        ['code' => 'BMD', 'name' => 'Bermudian Dollar', 'symbol' => '$'],
        ['code' => 'BND', 'name' => 'Brunei Dollar', 'symbol' => 'B$'],
        ['code' => 'BOB', 'name' => 'Bolivian Boliviano', 'symbol' => 'Bs.'],
        ['code' => 'BRL', 'name' => 'Brazilian Real', 'symbol' => 'R$'],
        ['code' => 'BSD', 'name' => 'Bahamian Dollar', 'symbol' => 'B$'],
        ['code' => 'BTN', 'name' => 'Bhutanese Ngultrum', 'symbol' => 'Nu.'],
        ['code' => 'BWP', 'name' => 'Botswana Pula', 'symbol' => 'P'],
        ['code' => 'BYN', 'name' => 'Belarusian Ruble', 'symbol' => 'Br'],
        ['code' => 'BZD', 'name' => 'Belize Dollar', 'symbol' => 'BZ$'],
        ['code' => 'CAD', 'name' => 'Canadian Dollar', 'symbol' => 'C$'],
        ['code' => 'CDF', 'name' => 'Congolese Franc', 'symbol' => 'FC'],
        ['code' => 'CHF', 'name' => 'Swiss Franc', 'symbol' => 'CHF'],
        ['code' => 'CLP', 'name' => 'Chilean Peso', 'symbol' => '$'],
        ['code' => 'CNY', 'name' => 'Chinese Yuan Renminbi', 'symbol' => '¥'],
        ['code' => 'COP', 'name' => 'Colombian Peso', 'symbol' => '$'],
        ['code' => 'CRC', 'name' => 'Costa Rican Colón', 'symbol' => '₡'],
        ['code' => 'CUP', 'name' => 'Cuban Peso', 'symbol' => '$'],
        ['code' => 'CVE', 'name' => 'Cape Verdean Escudo', 'symbol' => '$'],
        ['code' => 'CZK', 'name' => 'Czech Koruna', 'symbol' => 'Kč'],
        ['code' => 'DJF', 'name' => 'Djiboutian Franc', 'symbol' => 'Fdj'],
        ['code' => 'DKK', 'name' => 'Danish Krone', 'symbol' => 'kr'],
        ['code' => 'DOP', 'name' => 'Dominican Peso', 'symbol' => 'RD$'],
        ['code' => 'DZD', 'name' => 'Algerian Dinar', 'symbol' => 'د.ج'],
        ['code' => 'EGP', 'name' => 'Egyptian Pound', 'symbol' => '£E'],
        ['code' => 'ERN', 'name' => 'Eritrean Nakfa', 'symbol' => 'Nfk'],
        ['code' => 'ETB', 'name' => 'Ethiopian Birr', 'symbol' => 'Br'],
        ['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€'],
        ['code' => 'FJD', 'name' => 'Fijian Dollar', 'symbol' => 'FJ$'],
        ['code' => 'FKP', 'name' => 'Falkland Islands Pound', 'symbol' => '£'],
        ['code' => 'FOK', 'name' => 'Faroese Króna', 'symbol' => 'kr'],
        ['code' => 'GBP', 'name' => 'British Pound Sterling', 'symbol' => '£'],
        ['code' => 'GEL', 'name' => 'Georgian Lari', 'symbol' => '₾'],
        ['code' => 'GGP', 'name' => 'Guernsey Pound', 'symbol' => '£'],
        ['code' => 'GHS', 'name' => 'Ghanaian Cedi', 'symbol' => '₵'],
        ['code' => 'GIP', 'name' => 'Gibraltar Pound', 'symbol' => '£'],
        ['code' => 'GMD', 'name' => 'Gambian Dalasi', 'symbol' => 'D'],
        ['code' => 'GNF', 'name' => 'Guinean Franc', 'symbol' => 'FG'],
        ['code' => 'GTQ', 'name' => 'Guatemalan Quetzal', 'symbol' => 'Q'],
        ['code' => 'GYD', 'name' => 'Guyanese Dollar', 'symbol' => 'GY$'],
        ['code' => 'HKD', 'name' => 'Hong Kong Dollar', 'symbol' => 'HK$'],
        ['code' => 'HNL', 'name' => 'Honduran Lempira', 'symbol' => 'L'],
        ['code' => 'HRK', 'name' => 'Croatian Kuna', 'symbol' => 'kn'],
        ['code' => 'HTG', 'name' => 'Haitian Gourde', 'symbol' => 'G'],
        ['code' => 'HUF', 'name' => 'Hungarian Forint', 'symbol' => 'Ft'],
        ['code' => 'IDR', 'name' => 'Indonesian Rupiah', 'symbol' => 'Rp'],
        ['code' => 'ILS', 'name' => 'Israeli Shekel', 'symbol' => '₪'],
        ['code' => 'IMP', 'name' => 'Isle of Man Pound', 'symbol' => '£'],
        ['code' => 'INR', 'name' => 'Indian Rupee', 'symbol' => '₹'],
        ['code' => 'IQD', 'name' => 'Iraqi Dinar', 'symbol' => 'ع.د'],
        ['code' => 'IRR', 'name' => 'Iranian Rial', 'symbol' => '﷼'],
        ['code' => 'ISK', 'name' => 'Icelandic Króna', 'symbol' => 'kr'],
        ['code' => 'JMD', 'name' => 'Jamaican Dollar', 'symbol' => 'J$'],
        ['code' => 'JPY', 'name' => 'Japanese Yen', 'symbol' => '¥'],
        ['code' => 'KES', 'name' => 'Kenyan Shilling', 'symbol' => 'KSh'],
        ['code' => 'KGS', 'name' => 'Kyrgyzstani Som', 'symbol' => 'с'],
        ['code' => 'KHR', 'name' => 'Cambodian Riel', 'symbol' => '៛'],
        ['code' => 'KID', 'name' => 'Kiribati Dollar', 'symbol' => '$'],
        ['code' => 'KMF', 'name' => 'Comorian Franc', 'symbol' => 'CF'],
        ['code' => 'KRW', 'name' => 'South Korean Won', 'symbol' => '₩'],
        ['code' => 'KWD', 'name' => 'Kuwaiti Dinar', 'symbol' => 'د.ك'],
        ['code' => 'KYD', 'name' => 'Cayman Islands Dollar', 'symbol' => 'CI$'],
        ['code' => 'KZT', 'name' => 'Kazakhstani Tenge', 'symbol' => '₸'],
        ['code' => 'LAK', 'name' => 'Lao Kip', 'symbol' => '₭'],
        ['code' => 'LBP', 'name' => 'Lebanese Pound', 'symbol' => 'ل.ل'],
        ['code' => 'LKR', 'name' => 'Sri Lankan Rupee', 'symbol' => 'Rs'],
        ['code' => 'LRD', 'name' => 'Liberian Dollar', 'symbol' => 'L$'],
        ['code' => 'LSL', 'name' => 'Lesotho Loti', 'symbol' => 'L'],
        ['code' => 'LYD', 'name' => 'Libyan Dinar', 'symbol' => 'ل.د'],
        ['code' => 'MAD', 'name' => 'Moroccan Dirham', 'symbol' => 'د.م.'],
        ['code' => 'MDL', 'name' => 'Moldovan Leu', 'symbol' => 'L'],
        ['code' => 'MGA', 'name' => 'Malagasy Ariary', 'symbol' => 'Ar'],
        ['code' => 'MKD', 'name' => 'Macedonian Denar', 'symbol' => 'ден'],
        ['code' => 'MMK', 'name' => 'Burmese Kyat', 'symbol' => 'K'],
        ['code' => 'MNT', 'name' => 'Mongolian Tögrög', 'symbol' => '₮'],
        ['code' => 'MOP', 'name' => 'Macanese Pataca', 'symbol' => 'MOP$'],
        ['code' => 'MRU', 'name' => 'Mauritanian Ouguiya', 'symbol' => 'UM'],
        ['code' => 'MUR', 'name' => 'Mauritian Rupee', 'symbol' => '₨'],
        ['code' => 'MVR', 'name' => 'Maldivian Rufiyaa', 'symbol' => 'Rf'],
        ['code' => 'MWK', 'name' => 'Malawian Kwacha', 'symbol' => 'MK'],
        ['code' => 'MXN', 'name' => 'Mexican Peso', 'symbol' => '$'],
        ['code' => 'MYR', 'name' => 'Malaysian Ringgit', 'symbol' => 'RM'],
        ['code' => 'MZN', 'name' => 'Mozambican Metical', 'symbol' => 'MT'],
        ['code' => 'NAD', 'name' => 'Namibian Dollar', 'symbol' => 'N$'],
        ['code' => 'NGN', 'name' => 'Nigerian Naira', 'symbol' => '₦'],
        ['code' => 'NIO', 'name' => 'Nicaraguan Córdoba', 'symbol' => 'C$'],
        ['code' => 'NOK', 'name' => 'Norwegian Krone', 'symbol' => 'kr'],
        ['code' => 'NPR', 'name' => 'Nepalese Rupee', 'symbol' => '₨'],
        ['code' => 'NZD', 'name' => 'New Zealand Dollar', 'symbol' => 'NZ$'],
        ['code' => 'OMR', 'name' => 'Omani Rial', 'symbol' => 'ر.ع.'],
        ['code' => 'PAB', 'name' => 'Panamanian Balboa', 'symbol' => 'B/.'],
        ['code' => 'PEN', 'name' => 'Peruvian Sol', 'symbol' => 'S/'],
        ['code' => 'PGK', 'name' => 'Papua New Guinean Kina', 'symbol' => 'K'],
    ];

    protected array $symbols = [
        ['€' => ['EUR']]
    ];

    public function currency(): array
    {
        return $this->pickArrayRandomElement($this->currencies);
    }

    public function currencyCode(): string
    {
        return $this->currency()['code'];
    }

    public function currencyName(): string
    {
        return $this->currency()['name'];
    }

    public function currencySymbol(): string
    {
        return $this->currency()['symbol'];
    }
}
