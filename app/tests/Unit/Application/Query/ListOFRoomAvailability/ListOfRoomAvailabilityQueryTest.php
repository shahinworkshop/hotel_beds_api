<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Query\ListOFRoomAvailability;

use App\Application\Query\AuditData;
use App\Application\Query\ListOfRoomAvailability\ListOfRoomAvailability;
use App\Application\Query\ListOfRoomAvailability\ListOfRoomAvailabilityQuery;
use App\Domain\Booking\Dto\Availability\CheckAvailability;
use App\Domain\Booking\Dto\Availability\Hotels;
use App\Domain\Booking\Dto\Availability\Occupancies;
use App\Domain\Booking\Dto\Availability\Occupancy;
use App\Tests\Mock\Infrastructure\HttpClient\HotelBedsClient;
use PHPUnit\Framework\TestCase;

final class ListOfRoomAvailabilityQueryTest extends TestCase
{
    public function test_it_should_return_list_of_room_availability(): void
    {
        $sampleSuccessResponse = '{"auditData":{"processTime":129,"timestamp":"2023-01-08 13:17:30.462","requestHost":"86.83.204.35, 35.227.250.134, 130.211.1.174, 10.197.232.34","serverId":"ip-10-185-88-38.eu-west-1.compute.internal","environment":"[awseuwest1, awseuwest1a, ip_10_185_88_38]","release":"","token":"6A634D21F5BF459A8F3E2C3FAB39A962","internal":"0|D50499596C104F8167318025033600|NL|06|1|6||||||||||||9||1~1~2~0|0|0||0|ywsemqs2w6nr3dcspyubx42d||||"},"hotels":{"hotels":[{"code":168,"name":"Eurostars Marivent","categoryCode":"4EST","categoryName":"4 STARS","destinationCode":"PMI","destinationName":"Majorca","zoneCode":86,"zoneName":"Cala Mayor","latitude":"39.5526831653502","longitude":"2.61092998087406","rooms":[{"code":"DBT.ST","name":"Double or Twin STANDARD","rates":[{"rateKey":"20230615|20230616|W|1|168|DBT.ST|CG-ALL|RO||1~2~0||N@06~~200af~-845497535~N~~~NOR~D50499596C104F8167318025033600AANL0000001000000000623496","rateClass":"NOR","rateType":"BOOKABLE","net":"150.52","allotment":17,"paymentType":"AT_WEB","packaging":false,"boardCode":"RO","boardName":"ROOM ONLY","cancellationPolicies":[{"amount":"150.52","from":"2023-06-13T23:59:00+02:00"}],"rooms":1,"adults":2,"children":0},{"rateKey":"20230615|20230616|W|1|168|DBT.ST|CG-ALL BB|BB||1~2~0||N@06~~200c5~2021338946~N~~~NOR~D50499596C104F8167318025033600AANL0000001000000000622ca9","rateClass":"NOR","rateType":"BOOKABLE","net":"169.44","allotment":20,"paymentType":"AT_WEB","packaging":false,"boardCode":"BB","boardName":"BED AND BREAKFAST","cancellationPolicies":[{"amount":"169.44","from":"2023-06-13T23:59:00+02:00"}],"rooms":1,"adults":2,"children":0}]},{"code":"TPL.ST","name":"TRIPLE STANDARD","rates":[{"rateKey":"20230615|20230616|W|1|168|TPL.ST|CG-ALL|RO||1~2~0||N@06~~200f5~1808985478~N~~~NOR~D50499596C104F8167318025033600AANL00000010000000006249d2","rateClass":"NOR","rateType":"BOOKABLE","net":"210.73","allotment":3,"paymentType":"AT_WEB","packaging":false,"boardCode":"RO","boardName":"ROOM ONLY","cancellationPolicies":[{"amount":"210.73","from":"2023-06-13T23:59:00+02:00"}],"rooms":1,"adults":2,"children":0},{"rateKey":"20230615|20230616|W|1|168|TPL.ST|CG-ALL BB|BB||1~2~0||N@06~~200116~-1531974510~N~~~NOR~D50499596C104F8167318025033600AANL0000001000000000620bef","rateClass":"NOR","rateType":"BOOKABLE","net":"239.11","allotment":4,"paymentType":"AT_WEB","packaging":false,"boardCode":"BB","boardName":"BED AND BREAKFAST","cancellationPolicies":[{"amount":"239.11","from":"2023-06-13T23:59:00+02:00"}],"rooms":1,"adults":2,"children":0}]},{"code":"DBT.ST-1","name":"Double or Twin STANDARD","rates":[{"rateKey":"20230615|20230616|W|1|168|DBT.ST-1|CG-ALL|RO||1~2~0||N@06~~200f5~1363540708~N~~~NOR~D50499596C104F8167318025033600AANL00000010000000006249d2","rateClass":"NOR","rateType":"BOOKABLE","net":"210.73","allotment":4,"paymentType":"AT_WEB","packaging":false,"boardCode":"RO","boardName":"ROOM ONLY","cancellationPolicies":[{"amount":"210.73","from":"2023-06-13T23:59:00+02:00"}],"rooms":1,"adults":2,"children":0},{"rateKey":"20230615|20230616|W|1|168|DBT.ST-1|CG-ALL BB|BB||1~2~0||N@06~~200116~1426135792~N~~~NOR~D50499596C104F8167318025033600AANL0000001000000000620bef","rateClass":"NOR","rateType":"BOOKABLE","net":"239.11","allotment":3,"paymentType":"AT_WEB","packaging":false,"boardCode":"BB","boardName":"BED AND BREAKFAST","cancellationPolicies":[{"amount":"239.11","from":"2023-06-13T23:59:00+02:00"}],"rooms":1,"adults":2,"children":0}]}],"minRate":"150.52","maxRate":"239.11","currency":"EUR"}],"checkIn":"2023-06-15","total":1,"checkOut":"2023-06-16"}}';

        $hotelBedsClient = new HotelBedsClient();
        $hotelBedsClient->setHotelsAvailabilityResult(json_decode($sampleSuccessResponse, true));
        $listOfRoomAvailabilityQuery = new ListOfRoomAvailabilityQuery($hotelBedsClient);
        $listOfRoomAvailability = $listOfRoomAvailabilityQuery->byHotelCodeList($this->generateCheckAvailability());
        self::assertInstanceOf(ListOfRoomAvailability::class, $listOfRoomAvailability);
        self::assertObjectHasAttribute('hotels', $listOfRoomAvailability);
        self::assertObjectHasAttribute('auditData', $listOfRoomAvailability);
        self::assertInstanceOf(AuditData::class, $listOfRoomAvailability->auditData);
        self::assertInstanceOf(\App\Application\Query\Hotels::class, $listOfRoomAvailability->hotels);
    }

    public function test_it_should_throw_exception_of_room_availability(): void
    {
        $sampleSuccessResponse = '{}';

        $hotelBedsClient = new HotelBedsClient();
        $hotelBedsClient->setHotelsAvailabilityResult(json_decode($sampleSuccessResponse, true));
        $listOfRoomAvailabilityQuery = new ListOfRoomAvailabilityQuery($hotelBedsClient);

        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Error while parsing response: Invalid response');

        $listOfRoomAvailabilityQuery->byHotelCodeList($this->generateCheckAvailability());
    }

    private function generateCheckAvailability(): CheckAvailability
    {
        $occupancies = new Occupancies();
        $occupancies->add(new Occupancy(
            rooms: 1,
            adults: 2,
            children: 0,
        ));

        return new CheckAvailability(
            new \DateTimeImmutable('2023-04-01'),
            new \DateTimeImmutable('2023-04-04'),
            $occupancies,
            new Hotels([1,2,3,4]),
        );
    }
}