<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\Api\MiscApi;
use Aternos\ModrinthApi\Api\NotificationsApi;
use Aternos\ModrinthApi\Api\ProjectsApi;
use Aternos\ModrinthApi\Api\TagsApi;
use Aternos\ModrinthApi\Api\TeamsApi;
use Aternos\ModrinthApi\Api\ThreadsApi;
use Aternos\ModrinthApi\Api\UsersApi;
use Aternos\ModrinthApi\Api\VersionFilesApi;
use Aternos\ModrinthApi\Api\VersionsApi;
use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Client\List\PaginatedProjectSearchList;
use Aternos\ModrinthApi\Client\Options\ProjectSearchOptions;
use Aternos\ModrinthApi\Client\Tags\Category;
use Aternos\ModrinthApi\Client\Tags\DonationPlatform;
use Aternos\ModrinthApi\Client\Tags\GameVersion;
use Aternos\ModrinthApi\Client\Tags\License;
use Aternos\ModrinthApi\Client\Tags\Loader;
use Aternos\ModrinthApi\Client\Tags\ProjectType;
use Aternos\ModrinthApi\Client\Threads\Report;
use Aternos\ModrinthApi\Client\Threads\ReportItemType;
use Aternos\ModrinthApi\Client\Threads\Thread;
use Aternos\ModrinthApi\Client\Threads\ThreadMessageType;
use Aternos\ModrinthApi\Configuration;
use Aternos\ModrinthApi\Model\CategoryTag;
use Aternos\ModrinthApi\Model\CreatableReport;
use Aternos\ModrinthApi\Model\DonationPlatformTag;
use Aternos\ModrinthApi\Model\ForgeUpdates;
use Aternos\ModrinthApi\Model\GameVersionTag;
use Aternos\ModrinthApi\Model\GetLatestVersionFromHashBody;
use Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesBody;
use Aternos\ModrinthApi\Model\HashList;
use Aternos\ModrinthApi\Model\InvalidInputError;
use Aternos\ModrinthApi\Model\LicenseTag;
use Aternos\ModrinthApi\Model\LoaderTag;
use Aternos\ModrinthApi\Model\ModifyReportRequest;
use Aternos\ModrinthApi\Model\Notification as NotificationModel;
use Aternos\ModrinthApi\Model\Project as ProjectModel;
use Aternos\ModrinthApi\Model\Report as ReportModel;
use Aternos\ModrinthApi\Model\Statistics;
use Aternos\ModrinthApi\Model\TeamMember as TeamMemberModel;
use Aternos\ModrinthApi\Model\ThreadMessageBody;
use Aternos\ModrinthApi\Model\User as UserModel;
use Aternos\ModrinthApi\Model\UserPayoutHistory;
use Aternos\ModrinthApi\Model\Version as VersionModel;
use Aternos\ModrinthApi\Model\Thread as ThreadModel;
use Psr\Http\Client\ClientInterface;


/**
 * Class ModrinthAPIClient
 *
 * @description This class is the main entry point for the Modrinth API client.
 * @package Aternos\ModrinthApi\Client
 */
class ModrinthAPIClient
{
    protected ?ClientInterface $httpClient;

    protected Configuration $configuration;

    protected ?string $apiToken = null;

    protected ProjectsApi $projects;

    protected VersionsApi $versions;

    protected VersionFilesApi $versionFiles;

    protected UsersApi $users;

    protected TeamsApi $teams;

    protected TagsApi $tags;

    protected MiscApi $misc;

    protected NotificationsApi $notifications;

    protected ThreadsApi $threads;

    /**
     * ModrinthAPIClient constructor.
     * @param string|null $apiToken API token used for authentication
     * @param Configuration|null $configuration
     * @param ClientInterface|null $httpClient
     */
    public function __construct(?string $apiToken = null, ?Configuration $configuration = null, ClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient;
        $this->configuration = $configuration ?? (Configuration::getDefaultConfiguration())
            ->setUserAgent("php-modrinth-api/1.0.0");
        $this->setApiToken($apiToken);
    }

    /**
     * @param Configuration $configuration
     * @return $this
     */
    public function setConfiguration(Configuration $configuration): static
    {
        $this->configuration = $configuration;
        $this->configuration->setBooleanFormatForQueryString(Configuration::BOOLEAN_FORMAT_STRING);

        $this->projects = new ProjectsApi($this->httpClient, $this->configuration);
        $this->versions = new VersionsApi($this->httpClient, $this->configuration);
        $this->versionFiles = new VersionFilesApi($this->httpClient, $this->configuration);
        $this->users = new UsersApi($this->httpClient, $this->configuration);
        $this->teams = new TeamsApi($this->httpClient, $this->configuration);
        $this->tags = new TagsApi($this->httpClient, $this->configuration);
        $this->misc = new MiscApi($this->httpClient, $this->configuration);
        $this->notifications = new NotificationsApi($this->httpClient, $this->configuration);
        $this->threads = new ThreadsApi($this->httpClient, $this->configuration);

        return $this;
    }

    /**
     * Set the user agent used for HTTP requests
     * @param string $userAgent
     * @return $this
     */
    public function setUserAgent(string $userAgent): static
    {
        $this->configuration->setUserAgent($userAgent);
        return $this->setConfiguration($this->configuration);
    }

    /**
     * Set the API token used for authentication.
     * @param string|null $token
     * @return $this
     */
    public function setApiToken(?string $token): static
    {
        $this->apiToken = $token;
        $this->configuration->setApiKey("Authorization", $token);
        return $this->setConfiguration($this->configuration);
    }

    /**
     * Set the HTTP client used for all requests.
     * When null, the default HTTP client from Guzzle will be used.
     * @param ClientInterface|null $httpClient
     * @return $this
     */
    public function setHttpClient(?ClientInterface $httpClient): static
    {
        $this->httpClient = $httpClient;
        return $this->setConfiguration($this->configuration);
    }

    /**
     * Search projects
     * @param ProjectSearchOptions|null $options
     * @return PaginatedProjectSearchList
     * @throws ApiException
     */
    public function searchProjects(?ProjectSearchOptions $options = null): PaginatedProjectSearchList
    {
        $options = $options ?? new ProjectSearchOptions();
        $projects = $this->projects->searchProjects(
            $options->getQuery(),
            $options->getFacets()?->serialize(),
            $options->getIndex()->value,
            $options->getOffset(),
            $options->getLimit(),
            $options->getFilters(),
        );

        return new PaginatedProjectSearchList($this, $options, $projects);
    }

    /**
     * Get a project by ID or slug
     * @param string $idOrSlug Project ID or slug
     * @return Project
     * @throws ApiException
     */
    public function getProject(string $idOrSlug): Project
    {
        return new Project($this, $this->projects->getProject($idOrSlug));
    }

    /**
     * Get multiple projects by ID
     * @param string[] $ids
     * @return Project[]
     * @throws ApiException
     */
    public function getProjects(array $ids): array
    {
        return array_map(function (ProjectModel $project): Project {
            return new Project($this, $project);
        }, $this->projects->getProjects(json_encode($ids)));
    }

    /**
     * Get a list of random projects
     *
     * WARNING: this endpoint is buggy and often returns a lower amount of projects than requested
     * @link https://github.com/modrinth/labrinth/issues/548
     * @param int $count
     * @return Project[]
     * @throws ApiException
     */
    public function getRandomProjects(int $count): array
    {
        return array_map(function (ProjectModel $project): Project {
            return new Project($this, $project);
        }, $this->projects->randomProjects($count));
    }

    /**
     * Check if a project or slug is valid. Returns the project ID if the project is valid, null if not.
     * @param string $idOrSlug slug or id to check
     * @return string|null Project ID if the project is valid, null if not
     * @throws ApiException
     */
    public function checkProjectValidity(string $idOrSlug): ?string
    {
        try {
            return $this->projects->checkProjectValidity($idOrSlug)->getId();
        }
        catch (ApiException $exception) {
            if ($exception->getCode() === 404) {
                return null;
            }
            throw $exception;
        }
    }

    /**
     * Get a project's dependencies
     * @param string $idOrSlug
     * @return ProjectDependencies
     * @throws ApiException
     */
    public function getProjectDependencies(string $idOrSlug): ProjectDependencies
    {
        return new ProjectDependencies($this, $this->projects->getDependencies($idOrSlug));
    }

    /**
     * Get a project's version by ID or number
     * @param string $idOrSlug
     * @param string $version
     * @return Version
     * @throws ApiException
     */
    public function getProjectVersionFromIdOrNumber(string $idOrSlug, string $version): Version
    {
        return new Version($this, $this->versions->getVersionFromIdOrNumber($idOrSlug, $version));
    }

    /**
     * Get all versions of a project
     * @param string $idOrSlug Project ID or slug
     * @param string[]|null $loaders only show versions for any of these loaders // TODO: enum??
     * @param string[]|null $gameVersions
     * @param bool|null $featured
     * @return Version[]
     * @throws ApiException
     */
    public function getProjectVersions(
        string $idOrSlug,
        ?array $loaders = null,
        ?array $gameVersions = null,
        ?bool  $featured = null
    ): array
    {
        return array_map(function (VersionModel $version): Version {
            return new Version($this, $version);
        }, $this->versions->getProjectVersions(
            $idOrSlug,
            $loaders ? json_encode($loaders) : null,
            $gameVersions ? json_encode($gameVersions) : null,
            $featured
        ));
    }

    /**
     * Get a project version by ID
     * @param string $id
     * @return Version
     * @throws ApiException
     */
    public function getVersion(string $id): Version
    {
        return new Version($this, $this->versions->getVersion($id));
    }

    /**
     * Get multiple versions by ID
     * @param string[] $ids
     * @return Version[]
     * @throws ApiException
     */
    public function getVersions(array $ids): array
    {
        return array_map(function (VersionModel $version): Version {
            return new Version($this, $version);
        }, $this->versions->getVersions(json_encode($ids)));
    }

    /**
     * Get a version by its hash
     * @param string $hash
     * @param HashAlgorithm $algorithm
     * @return Version
     * @throws ApiException
     */
    public function getVersionFromHash(string $hash, HashAlgorithm $algorithm = HashAlgorithm::SHA1): Version
    {
        return new Version($this, $this->versionFiles->versionFromHash($hash, $algorithm->value));
    }

    /**
     * Get multiple versions by their hashes
     * @param string[] $hashes
     * @param HashAlgorithm $algorithm
     * @return Version[]
     * @throws ApiException
     */
    public function getVersionsFromHashes(array $hashes, HashAlgorithm $algorithm = HashAlgorithm::SHA1): array
    {
        $hashList = new HashList();
        $hashList->setHashes($hashes);
        $hashList->setAlgorithm($algorithm->value);

        return array_map(function (VersionModel $version): Version {
            return new Version($this, $version);
        }, $this->versionFiles->versionsFromHashes($hashList));
    }

    /**
     * @param string $hash
     * @param string[] $loaders
     * @param string[] $gameVersions
     * @param HashAlgorithm $algorithm
     * @return Version
     * @throws ApiException
     */
    public function getLatestVersionFromHash(
        string        $hash,
        array         $loaders,
        array         $gameVersions,
        HashAlgorithm $algorithm = HashAlgorithm::SHA1
    ): Version
    {
        $body = new GetLatestVersionFromHashBody();
        $body->setGameVersions($gameVersions);
        $body->setLoaders($loaders);
        return new Version($this, $this->versionFiles->getLatestVersionFromHash($hash, $algorithm->value, $body));
    }

    /**
     * Get the latest version of multiple hashes
     * @param string[] $hashes
     * @param string[] $loaders
     * @param string[] $gameVersions
     * @param HashAlgorithm $algorithm
     * @return Version[]
     * @throws ApiException
     */
    public function getLatestVersionsFromHashes(
        array $hashes,
        array $loaders,
        array $gameVersions,
        HashAlgorithm $algorithm = HashAlgorithm::SHA1
    ): array
    {
        $body = new GetLatestVersionsFromHashesBody();
        $body->setHashes($hashes);
        $body->setAlgorithm($algorithm->value);
        $body->setLoaders($loaders);
        $body->setGameVersions($gameVersions);
        $body->setLoaders($loaders);
        return array_map(function (VersionModel $version): Version {
            return new Version($this, $version);
        }, $this->versionFiles->getLatestVersionsFromHashes($body));
    }

    /**
     * Get a user by ID or name
     * @param string $idOrName
     * @return User
     * @throws ApiException
     */
    public function getUser(string $idOrName): User
    {
        return new User($this, $this->users->getUser($idOrName));
    }

    /**
     * Get the user from the API token (requires authentication)
     * @return User
     * @throws ApiException
     */
    public function getCurrentUser(): User
    {
        if ($this->apiToken === null) {
            throw new ApiException("No API token set");
        }

        return new User($this, $this->users->getUserFromAuth());
    }

    /**
     * Get multiple users by ID
     * @param string[] $ids
     * @return User[]
     * @throws ApiException
     */
    public function getUsers(array $ids): array
    {
        return array_map(function (UserModel $user): User {
            return new User($this, $user);
        }, $this->users->getUsers(json_encode($ids)));
    }

    /**
     * Get a user's projects
     * @param string $idOrName
     * @return Project[]
     * @throws ApiException
     */
    public function getUserProjects(string $idOrName): array
    {
        return array_map(function (ProjectModel $project): Project {
            return new Project($this, $project);
        }, $this->users->getUserProjects($idOrName));
    }

    /**
     * Get a user's followed projects (requires authentication)
     * @param string $idOrUsername
     * @return Project[]
     * @throws ApiException
     */
    public function getFollowedProjects(string $idOrUsername): array
    {
        if ($this->apiToken === null) {
            throw new ApiException("No API token set");
        }

        return array_map(function (ProjectModel $data): Project {
            return new Project($this, $data);
        }, $this->users->getFollowedProjects($idOrUsername));
    }

    /**
     * Get a user's payout history (requires authentication)
     * @param string $idOrUsername
     * @return UserPayoutHistory
     * @throws ApiException
     */
    public function getPayoutHistory(string $idOrUsername): UserPayoutHistory
    {
        if ($this->apiToken === null) {
            throw new ApiException("No API token set");
        }

        return $this->users->getPayoutHistory($idOrUsername);
    }

    /**
     * Get members of a project
     * @param string $idOrSlug
     * @return TeamMember[]
     * @throws ApiException
     */
    public function getProjectMembers(string $idOrSlug): array
    {
        return array_map(function (TeamMemberModel $member): TeamMember {
            return new TeamMember($this, $member);
        }, $this->teams->getProjectTeamMembers($idOrSlug));
    }

    /**
     * Get members of a team
     * @param string $id
     * @return TeamMember[]
     * @throws ApiException
     */
    public function getTeamMembers(string $id): array
    {
        return array_map(function (TeamMemberModel $member): TeamMember {
            return new TeamMember($this, $member);
        }, $this->teams->getTeamMembers($id));
    }

    /**
     * Get the members of multiple teams at once
     * @param string[] $ids
     * @return TeamMember[][]
     * @throws ApiException
     */
    public function getTeams(array $ids): array
    {
        $result = [];
        foreach ($this->teams->getTeams(json_encode($ids)) as $members) {
            $result[] = array_map(function (TeamMemberModel $member): TeamMember {
                return new TeamMember($this, $member);
            }, $members);
        }

        return $result;
    }

    /**
     * Get all categories
     * @return Category[]
     * @throws ApiException
     */
    public function getCategories(): array
    {
        return array_map(function (CategoryTag $category): Category {
            return new Category($this, $category);
        }, $this->tags->categoryList());
    }

    /**
     * Get all loaders
     * @return Loader[]
     * @throws ApiException
     */
    public function getLoaders(): array
    {
        return array_map(function (LoaderTag $loader): Loader {
            return new Loader($this, $loader);
        }, $this->tags->loaderList());
    }

    /**
     * Get all game versions
     * @return GameVersion[]
     * @throws ApiException
     */
    public function getGameVersions(): array
    {
        return array_map(function (GameVersionTag $loader): GameVersion {
            return new GameVersion($this, $loader);
        }, $this->tags->versionList());
    }

    /**
     * Get all licenses
     * @return License[]
     * @throws ApiException
     * @deprecated simply use SPDX IDs
     */
    public function getLicenses(): array
    {
        return array_map(function (LicenseTag $license): License {
            return new License($this, $license);
        }, $this->tags->licenseList());
    }

    /**
     * Get a license by its SPDX ID
     * @param string $spdxId SPDX ID
     * @return string
     * @throws ApiException
     */
    public function getLicenseText(string $spdxId): string
    {
        return $this->tags->licenseText($spdxId);
    }

    /**
     * Get all project types
     * @return ProjectType[]
     * @throws ApiException
     */
    public function getProjectTypes(): array
    {
        return array_map(function (string $type): ProjectType {
            return new ProjectType($this, $type);
        }, $this->tags->projectTypeList());
    }

    /**
     * Get all side types
     * @return string[]
     * @throws ApiException
     */
    public function getSideTypes(): array
    {
        return $this->tags->sideTypeList();
    }

    /**
     * Get all donation platforms
     * @return DonationPlatform[]
     * @throws ApiException
     */
    public function getDonationPlatforms(): array
    {
        return array_map(function (DonationPlatformTag $platform): DonationPlatform {
            return new DonationPlatform($this, $platform);
        }, $this->tags->donationPlatformList());
    }

    /**
     * Get all report reasons
     * @return string[]
     * @throws ApiException
     */
    public function getReportTypes(): array
    {
        return $this->tags->reportTypeList();
    }

    /**
     * Get statistics about modrinth
     * @return Statistics
     * @throws ApiException
     */
    public function getStatistics(): Statistics
    {
        return $this->misc->statistics();
    }

    /**
     * Get the forge update data for a mod
     * @param string $idOrSlug
     * @return ForgeUpdates|InvalidInputError
     * @throws ApiException
     */
    public function getForgeUpdates(string $idOrSlug): ForgeUpdates|InvalidInputError
    {
        return $this->misc->forgeUpdates($idOrSlug);
    }

    /**
     * Get a notification by ID (requires authentication)
     * @param string $id notification ID
     * @return Notification
     * @throws ApiException
     */
    public function getNotification(string $id): Notification
    {
        return new Notification($this, $this->notifications->getNotification($id));
    }

    /**
     * Get multiple notifications by ID (requires authentication)
     * @param string[] $ids notification IDs
     * @return Notification[]
     * @throws ApiException
     */
    public function getNotifications(array $ids): array
    {
        return array_map(function (NotificationModel $notification): Notification {
            return new Notification($this, $notification);
        }, $this->notifications->getNotifications(json_encode($ids)));
    }

    /**
     * Delete a notification by ID (requires authentication)
     * @param string $id notification ID
     * @throws ApiException
     */
    public function deleteNotification(string $id): void
    {
        $this->notifications->deleteNotification($id);
    }

    /**
     * Delete multiple notifications by ID (requires authentication)
     * @param string[] $ids notification IDs
     * @throws ApiException
     */
    public function deleteNotifications(array $ids): void
    {
        $this->notifications->deleteNotifications(json_encode($ids));
    }

    /**
     * Get a user's notifications (project updates or team invites) (requires authentication)
     * @param string $idOrUsername
     * @return Notification[]
     * @throws ApiException
     */
    public function getUserNotifications(string $idOrUsername): array
    {
        if ($this->apiToken === null) {
            throw new ApiException("No API token set");
        }

        return array_map(function (NotificationModel $notification): Notification {
            return new Notification($this, $notification);
        }, $this->notifications->getUserNotifications($idOrUsername));
    }

    /**
     * Mark a notification as read (requires authentication)
     * @param string $id notification ID
     * @throws ApiException
     */
    public function readNotification(string $id): void
    {
        $this->notifications->readNotification($id);
    }

    /**
     * Mark multiple notifications as read (requires authentication)
     * @param string[] $ids notification IDs
     * @throws ApiException
     */
    public function readNotifications(array $ids): void
    {
        $this->notifications->readNotifications(json_encode($ids));
    }

    /**
     * Report a project, user, or version (requires authentication)
     * @param string $reportType The type of the report being sent
     * @param string $itemId The ID of the item (project, version, or user) being reported
     * @param ReportItemType $itemType The type of the item being reported
     * @param string $body
     * @return Report
     * @throws ApiException
     */
    public function submitReport(string $reportType, string $itemId, ReportItemType $itemType, string $body): Report
    {
        $report = new CreatableReport();
        $report->setReportType($reportType);
        $report->setItemId($itemId);
        $report->setItemType($itemType->value);
        $report->setBody($body);

        return new Report($this, $this->threads->submitReport($report));
    }

    /**
     * Get your open reports (requires authentication)
     * @return Report[]
     * @throws ApiException
     */
    public function getOpenReports(): array
    {
        return array_map(function (ReportModel $report): Report {
            return new Report($this, $report);
        }, $this->threads->getOpenReports());
    }

    /**
     * Get a report by ID (requires authentication)
     * @param string $id report ID
     * @return Report
     * @throws ApiException
     */
    public function getReport(string $id): Report
    {
        return new Report($this, $this->threads->getReport($id));
    }

    /**
     * @param string $id
     * @param string|null $body
     * @param boolean|null $closed
     * @return void
     * @throws ApiException
     */
    public function modifyReport(string $id, ?string $body, ?bool $closed): void
    {
        $report = new ModifyReportRequest();
        $report->setBody($body);
        $report->setClosed($closed);

        $this->threads->modifyReport($id, $report);
    }

    /**
     * Get multiple reports by ID (requires authentication)
     * @param string[] $ids
     * @return Report[]
     * @throws ApiException
     */
    public function getReports(array $ids): array
    {
        return array_map(function (ReportModel $report): Report {
            return new Report($this, $report);
        }, $this->threads->getReports(json_encode($ids)));
    }

    /**
     * Get a thread (requires authentication)
     * @param string $id
     * @return Thread
     * @throws ApiException
     */
    public function getThread(string $id): Thread
    {
        return new Thread($this, $this->threads->getThread($id));
    }

    /**
     * Get multiple threads by ID (requires authentication)
     * @param string[] $ids
     * @return Thread[]
     * @throws ApiException
     */
    public function getThreads(array $ids): array
    {
        return array_map(function (ThreadModel $thread): Thread {
            return new Thread($this, $thread);
        }, $this->threads->getThreads(json_encode($ids)));
    }

    /**
     * Send a message to a thread (requires authentication)
     * @param string $threadId
     * @param ThreadMessageType $messageType
     * @param string|null $body
     * @param bool|null $private
     * @param string|null $replyingTo
     * @param string|null $oldStatus
     * @param string|null $newStatus
     * @return Thread
     * @throws ApiException
     */
    public function sendThreadMessage(
        string            $threadId,
        ThreadMessageType $messageType,
        ?string           $body = null,
        ?bool             $private = null,
        ?string           $replyingTo = null,
        ?string           $oldStatus = null,
        ?string           $newStatus = null,
    ): Thread
    {
        $message = new ThreadMessageBody();
        $message->setType($messageType->value);
        $message->setBody($body);
        $message->setPrivate($private);
        $message->setReplyingTo($replyingTo);
        $message->setOldStatus($oldStatus);
        $message->setNewStatus($newStatus);
        return new Thread($this, $this->threads->sendThreadMessage($threadId, $message));
    }

    /**
     * Delete a thread message (requires authentication)
     * @param string $threadId
     * @param string $messageId
     * @return void
     * @throws ApiException
     */
    public function deleteThreadMessage(string $threadId, string $messageId): void
    {
        $this->threads->deleteThreadMessage($threadId, $messageId);
    }
}