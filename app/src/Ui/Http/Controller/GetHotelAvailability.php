<?php

declare(strict_types=1);

namespace App\Ui\Http\Controller;

use App\Application\Query\ListOfRoomAvailability\ListOfRoomAvailabilityQuery;
use App\Framework\InvalidArgumentException;
use App\Ui\Http\Controller\CheckAvailability\CheckAvailabilityRequestParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hotels/availability', name: 'hotel_room_availability', methods: 'POST')]
final class GetHotelAvailability extends AbstractController
{
    public function __invoke(
        ListOfRoomAvailabilityQuery $query,
        CheckAvailabilityRequestParser $requestParser,
        Request $request,
    ): JsonResponse {
        try {
            $checkAvailability = $requestParser->generate($request);
            $response = $query->byHotelCodeList($checkAvailability);

            return new JsonResponse(
                data: $response,
                status: Response::HTTP_OK,
            );
        } catch (HttpException $e) {
            return new JsonResponse(
                data: ['message' => $e->getMessage()],
                status: $e->getStatusCode(),
            );
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(
                data: ['message' => $e->getMessage()],
                status: Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception $e) {
            return new JsonResponse(
                data: ['message' => $e->getMessage()],
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
