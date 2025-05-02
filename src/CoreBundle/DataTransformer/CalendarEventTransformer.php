<?php

/* For licensing terms, see /license.txt */

declare(strict_types=1);

namespace Chamilo\CoreBundle\DataTransformer;

<<<<<<< HEAD
use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
=======
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
use Chamilo\CoreBundle\ApiResource\CalendarEvent;
use Chamilo\CoreBundle\Entity\AgendaReminder;
use Chamilo\CoreBundle\Entity\Session;
use Chamilo\CoreBundle\Entity\SessionRelCourse;
use Chamilo\CoreBundle\Repository\Node\UsergroupRepository;
use Chamilo\CoreBundle\Settings\SettingsManager;
use Chamilo\CourseBundle\Entity\CCalendarEvent;
<<<<<<< HEAD
use Chamilo\CourseBundle\Repository\CCalendarEventRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class CalendarEventTransformer implements DataTransformerInterface
{
    public function __construct(
        private readonly RouterInterface $router,
        private readonly UsergroupRepository $usergroupRepository,
        private readonly CCalendarEventRepository $calendarEventRepository,
        private readonly SettingsManager $settingsManager,
    ) {}

    public function transform($object, string $to, array $context = []): object
=======
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

readonly class CalendarEventTransformer
{
    public function __construct(
        private RouterInterface $router,
        private UsergroupRepository $usergroupRepository,
        private SettingsManager $settingsManager,
    ) {}

    public function transform(CCalendarEvent|Session $object): object
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        if ($object instanceof Session) {
            return $this->mapSessionToDto($object);
        }

        return $this->mapCCalendarToDto($object);
    }

<<<<<<< HEAD
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return ($data instanceof CCalendarEvent || $data instanceof Session) && CalendarEvent::class === $to;
    }

    private function mapCCalendarToDto(object $object): CalendarEvent
    {
        \assert($object instanceof CCalendarEvent);

=======
    private function mapCCalendarToDto(CCalendarEvent $object): CalendarEvent
    {
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        $object->setResourceLinkListFromEntity();

        $subscriptionItemTitle = null;

        if (CCalendarEvent::SUBSCRIPTION_VISIBILITY_CLASS == $object->getSubscriptionVisibility()) {
            $subscriptionItemTitle = $this->usergroupRepository->find($object->getSubscriptionItemId())?->getTitle();
        }

        $eventType = $object->determineType();
<<<<<<< HEAD
        $color = $this->determineEventColor($eventType);
=======
        $color = trim((string) $object->getColor());
        $color = '' !== $color ? $color : $this->determineEventColor($eventType);
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

        $calendarEvent = new CalendarEvent(
            'calendar_event_'.$object->getIid(),
            $object->getTitle(),
            $object->getContent(),
            $object->getStartDate(),
            $object->getEndDate(),
            $object->isAllDay(),
            null,
            $object->getInvitationType(),
            $object->isCollective(),
            $object->getSubscriptionVisibility(),
            $object->getSubscriptionItemId(),
            $subscriptionItemTitle,
            $object->getMaxAttendees(),
            null,
            $object->getResourceNode(),
            $object->getResourceLinkListFromEntity(),
            $color
        );

        $calendarEvent->setType($eventType);

        $object->getReminders()->forAll(fn (int $i, AgendaReminder $reminder) => $reminder->encodeDateInterval());

        $calendarEvent->reminders = $object->getReminders();

        return $calendarEvent;
    }

<<<<<<< HEAD
    private function mapSessionToDto(object $object): CalendarEvent
    {
        \assert($object instanceof Session);

        /** @var ?SessionRelCourse $sessionRelCourse */
        $sessionRelCourse = $object->getCourses()->first();
        $course = $sessionRelCourse?->getCourse();
=======
    private function mapSessionToDto(Session $object): CalendarEvent
    {
        $course = null;

        /** @var ?SessionRelCourse $sessionRelCourse */
        if ($object->getCourses()->first() instanceof SessionRelCourse) {
            $course = $object->getCourses()->first()->getCourse();
        }
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

        $sessionUrl = null;

        if ($course) {
            $baseUrl = $this->router->generate('index', [], UrlGeneratorInterface::ABSOLUTE_URL);

            $sessionUrl = "{$baseUrl}course/{$course->getId()}/home?".http_build_query(['sid' => $object->getId()]);
        }

        return new CalendarEvent(
            'session_'.$object->getId(),
            $object->getTitle(),
            $object->getShowDescription() ? $object->getDescription() : null,
            $object->getDisplayStartDate(),
            $object->getDisplayEndDate(),
            false,
            $sessionUrl,
        );
    }

    private function determineEventColor(string $eventType): string
    {
        $defaultColors = [
<<<<<<< HEAD
            'platform' => 'red',
            'course' => '#458B00',
            'session' => '#00496D',
            'personal' => 'steel blue',
=======
            'platform' => '#FF0000',
            'course' => '#458B00',
            'session' => '#00496D',
            'personal' => '#4682B4',
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        ];

        $agendaColors = [];
        $settingAgendaColors = $this->settingsManager->getSetting('agenda.agenda_colors');
        if (\is_array($settingAgendaColors)) {
            $agendaColors = array_merge($defaultColors, $settingAgendaColors);
        }

        $colorKeyMap = [
            'global' => 'platform',
        ];

        $colorKey = $colorKeyMap[$eventType] ?? $eventType;

        return $agendaColors[$colorKey] ?? $defaultColors[$colorKey];
    }
}
