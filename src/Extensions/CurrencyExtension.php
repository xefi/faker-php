<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;

class CurrencyExtension extends Extension
{
    use HasLocale;

    protected array $currencies = [
        ['code' => 'AED', 'name' => 'Dirham des Émirats arabes unis', 'symbol' => 'د.إ'],
        ['code' => 'AFN', 'name' => 'Afghani afghan', 'symbol' => '؋'],
        ['code' => 'ALL', 'name' => 'Lek albanais', 'symbol' => 'L'],
        ['code' => 'AMD', 'name' => 'Dram arménien', 'symbol' => '֏'],
        ['code' => 'ANG', 'name' => 'Florin antillais néerlandais', 'symbol' => 'ƒ'],
        ['code' => 'AOA', 'name' => 'Kwanza angolais', 'symbol' => 'Kz'],
        ['code' => 'ARS', 'name' => 'Peso argentin', 'symbol' => '$'],
        ['code' => 'AUD', 'name' => 'Dollar australien', 'symbol' => 'A$'],
        ['code' => 'AWG', 'name' => 'Florin arubais', 'symbol' => 'ƒ'],
        ['code' => 'AZN', 'name' => 'Manat azerbaïdjanais', 'symbol' => '₼'],
        ['code' => 'BAM', 'name' => 'Mark convertible bosniaque', 'symbol' => 'KM'],
        ['code' => 'BBD', 'name' => 'Dollar barbadien', 'symbol' => 'Bds$'],
        ['code' => 'BDT', 'name' => 'Taka bangladais', 'symbol' => '৳'],
        ['code' => 'BGN', 'name' => 'Lev bulgare', 'symbol' => 'лв'],
        ['code' => 'BHD', 'name' => 'Dinar bahreïni', 'symbol' => '.د.ب'],
        ['code' => 'BIF', 'name' => 'Franc burundais', 'symbol' => 'FBu'],
        ['code' => 'BMD', 'name' => 'Dollar bermudien', 'symbol' => '$'],
        ['code' => 'BND', 'name' => 'Dollar brunéien', 'symbol' => 'B$'],
        ['code' => 'BOB', 'name' => 'Boliviano bolivien', 'symbol' => 'Bs.'],
        ['code' => 'BRL', 'name' => 'Réal brésilien', 'symbol' => 'R$'],
        ['code' => 'BSD', 'name' => 'Dollar bahaméen', 'symbol' => 'B$'],
        ['code' => 'BTN', 'name' => 'Ngultrum bhoutanais', 'symbol' => 'Nu.'],
        ['code' => 'BWP', 'name' => 'Pula botswanais', 'symbol' => 'P'],
        ['code' => 'BYN', 'name' => 'Rouble biélorusse', 'symbol' => 'Br'],
        ['code' => 'BZD', 'name' => 'Dollar bélizien', 'symbol' => 'BZ$'],
        ['code' => 'CAD', 'name' => 'Dollar canadien', 'symbol' => 'C$'],
        ['code' => 'CDF', 'name' => 'Franc congolais', 'symbol' => 'FC'],
        ['code' => 'CHF', 'name' => 'Franc suisse', 'symbol' => 'CHF'],
        ['code' => 'CLP', 'name' => 'Peso chilien', 'symbol' => '$'],
        ['code' => 'CNY', 'name' => 'Yuan renminbi chinois', 'symbol' => '¥'],
        ['code' => 'COP', 'name' => 'Peso colombien', 'symbol' => '$'],
        ['code' => 'CRC', 'name' => 'Colón costaricien', 'symbol' => '₡'],
        ['code' => 'CUP', 'name' => 'Peso cubain', 'symbol' => '$'],
        ['code' => 'CVE', 'name' => 'Escudo capverdien', 'symbol' => '$'],
        ['code' => 'CZK', 'name' => 'Couronne tchèque', 'symbol' => 'Kč'],
        ['code' => 'DJF', 'name' => 'Franc djiboutien', 'symbol' => 'Fdj'],
        ['code' => 'DKK', 'name' => 'Couronne danoise', 'symbol' => 'kr'],
        ['code' => 'DOP', 'name' => 'Peso dominicain', 'symbol' => 'RD$'],
        ['code' => 'DZD', 'name' => 'Dinar algérien', 'symbol' => 'د.ج'],
        ['code' => 'EGP', 'name' => 'Livre égyptienne', 'symbol' => '£E'],
        ['code' => 'ERN', 'name' => 'Nakfa érythréen', 'symbol' => 'Nfk'],
        ['code' => 'ETB', 'name' => 'Birr éthiopien', 'symbol' => 'Br'],
        ['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€'],
        ['code' => 'FJD', 'name' => 'Dollar fidjien', 'symbol' => 'FJ$'],
        ['code' => 'FKP', 'name' => 'Livre des îles Falkland', 'symbol' => '£'],
        ['code' => 'FOK', 'name' => 'Couronne féroïenne', 'symbol' => 'kr'],
        ['code' => 'GBP', 'name' => 'Livre sterling', 'symbol' => '£'],
        ['code' => 'GEL', 'name' => 'Lari géorgien', 'symbol' => '₾'],
        ['code' => 'GGP', 'name' => 'Livre de Guernesey', 'symbol' => '£'],
        ['code' => 'GHS', 'name' => 'Cedi ghanéen', 'symbol' => '₵'],
        ['code' => 'GIP', 'name' => 'Livre de Gibraltar', 'symbol' => '£'],
        ['code' => 'GMD', 'name' => 'Dalasi gambien', 'symbol' => 'D'],
        ['code' => 'GNF', 'name' => 'Franc guinéen', 'symbol' => 'FG'],
        ['code' => 'GTQ', 'name' => 'Quetzal guatémaltèque', 'symbol' => 'Q'],
        ['code' => 'GYD', 'name' => 'Dollar du Guyana', 'symbol' => 'GY$'],
        ['code' => 'HKD', 'name' => 'Dollar de Hong Kong', 'symbol' => 'HK$'],
        ['code' => 'HNL', 'name' => 'Lempira hondurien', 'symbol' => 'L'],
        ['code' => 'HRK', 'name' => 'Kuna croate', 'symbol' => 'kn'],
        ['code' => 'HTG', 'name' => 'Gourde haïtienne', 'symbol' => 'G'],
        ['code' => 'HUF', 'name' => 'Forint hongrois', 'symbol' => 'Ft'],
        ['code' => 'IDR', 'name' => 'Roupie indonésienne', 'symbol' => 'Rp'],
        ['code' => 'ILS', 'name' => 'Shekel israélien', 'symbol' => '₪'],
        ['code' => 'IMP', 'name' => 'Livre mannoise', 'symbol' => '£'],
        ['code' => 'INR', 'name' => 'Roupie indienne', 'symbol' => '₹'],
        ['code' => 'IQD', 'name' => 'Dinar irakien', 'symbol' => 'ع.د'],
        ['code' => 'IRR', 'name' => 'Rial iranien', 'symbol' => '﷼'],
        ['code' => 'ISK', 'name' => 'Couronne islandaise', 'symbol' => 'kr'],
        ['code' => 'JMD', 'name' => 'Dollar jamaïcain', 'symbol' => 'J$'],
        ['code' => 'JPY', 'name' => 'Yen japonais', 'symbol' => '¥'],
        ['code' => 'KES', 'name' => 'Shilling kényan', 'symbol' => 'KSh'],
        ['code' => 'KGS', 'name' => 'Som kirghize', 'symbol' => 'с'],
        ['code' => 'KHR', 'name' => 'Riel cambodgien', 'symbol' => '៛'],
        ['code' => 'KID', 'name' => 'Dollar des Kiribati', 'symbol' => '$'],
        ['code' => 'KMF', 'name' => 'Franc comorien', 'symbol' => 'CF'],
        ['code' => 'KRW', 'name' => 'Won sud-coréen', 'symbol' => '₩'],
        ['code' => 'KWD', 'name' => 'Dinar koweïtien', 'symbol' => 'د.ك'],
        ['code' => 'KYD', 'name' => 'Dollar des îles Caïmans', 'symbol' => 'CI$'],
        ['code' => 'KZT', 'name' => 'Tenge kazakh', 'symbol' => '₸'],
        ['code' => 'LAK', 'name' => 'Kip laotien', 'symbol' => '₭'],
        ['code' => 'LBP', 'name' => 'Livre libanaise', 'symbol' => 'ل.ل'],
        ['code' => 'LKR', 'name' => 'Roupie srilankaise', 'symbol' => 'Rs'],
        ['code' => 'LRD', 'name' => 'Dollar libérien', 'symbol' => 'L$'],
        ['code' => 'LSL', 'name' => 'Loti du Lesotho', 'symbol' => 'L'],
        ['code' => 'LYD', 'name' => 'Dinar libyen', 'symbol' => 'ل.د'],
        ['code' => 'MAD', 'name' => 'Dirham marocain', 'symbol' => 'د.م.'],
        ['code' => 'MDL', 'name' => 'Leu moldave', 'symbol' => 'L'],
        ['code' => 'MGA', 'name' => 'Ariary malgache', 'symbol' => 'Ar'],
        ['code' => 'MKD', 'name' => 'Denar macédonien', 'symbol' => 'ден'],
        ['code' => 'MMK', 'name' => 'Kyat birman', 'symbol' => 'K'],
        ['code' => 'MNT', 'name' => 'Tugrik mongol', 'symbol' => '₮'],
        ['code' => 'MOP', 'name' => 'Pataca macanaise', 'symbol' => 'MOP$'],
        ['code' => 'MRU', 'name' => 'Ouguiya mauritanien', 'symbol' => 'UM'],
        ['code' => 'MUR', 'name' => 'Roupie mauricienne', 'symbol' => '₨'],
        ['code' => 'MVR', 'name' => 'Rufiyaa maldivien', 'symbol' => 'Rf'],
        ['code' => 'MWK', 'name' => 'Kwacha malawien', 'symbol' => 'MK'],
        ['code' => 'MXN', 'name' => 'Peso mexicain', 'symbol' => '$'],
        ['code' => 'MYR', 'name' => 'Ringgit malaisien', 'symbol' => 'RM'],
        ['code' => 'MZN', 'name' => 'Metical mozambicain', 'symbol' => 'MT'],
        ['code' => 'NAD', 'name' => 'Dollar namibien', 'symbol' => 'N$'],
        ['code' => 'NGN', 'name' => 'Naira nigérian', 'symbol' => '₦'],
        ['code' => 'NIO', 'name' => 'Córdoba nicaraguayen', 'symbol' => 'C$'],
        ['code' => 'NOK', 'name' => 'Couronne norvégienne', 'symbol' => 'kr'],
        ['code' => 'NPR', 'name' => 'Roupie népalaise', 'symbol' => '₨'],
        ['code' => 'NZD', 'name' => 'Dollar néo-zélandais', 'symbol' => 'NZ$'],
        ['code' => 'OMR', 'name' => 'Rial omanais', 'symbol' => 'ر.ع.'],
        ['code' => 'PAB', 'name' => 'Balboa panaméen', 'symbol' => 'B/.'],
        ['code' => 'PEN', 'name' => 'Sol péruvien', 'symbol' => 'S/'],
        ['code' => 'PGK', 'name' => 'Kina papouasien', 'symbol' => 'K'],
    ];

    public function currency(): array
    {
        return $this->currencies[array_rand($this->currencies)];
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
