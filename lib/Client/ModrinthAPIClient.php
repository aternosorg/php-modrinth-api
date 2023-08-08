<?php

namespace Aternos\ModrinthApi\Client;

use Aternos\ModrinthApi\Api\MiscApi;
use Aternos\ModrinthApi\Api\ProjectsApi;
use Aternos\ModrinthApi\Api\TagsApi;
use Aternos\ModrinthApi\Api\TeamsApi;
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
use Aternos\ModrinthApi\Configuration;
use Aternos\ModrinthApi\Model\CategoryTag;
use Aternos\ModrinthApi\Model\DonationPlatformTag;
use Aternos\ModrinthApi\Model\GameVersionTag;
use Aternos\ModrinthApi\Model\GetLatestVersionFromHashBody;
use Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesBody;
use Aternos\ModrinthApi\Model\HashList;
use Aternos\ModrinthApi\Model\LicenseTag;
use Aternos\ModrinthApi\Model\LoaderTag;
use Aternos\ModrinthApi\Model\Notification as NotificationModel;
use Aternos\ModrinthApi\Model\Project as ProjectModel;
use Aternos\ModrinthApi\Model\Statistics;
use Aternos\ModrinthApi\Model\TeamMember as TeamMemberModel;
use Aternos\ModrinthApi\Model\User as UserModel;
use Aternos\ModrinthApi\Model\UserPayoutHistory;
use Aternos\ModrinthApi\Model\Version as VersionModel;

/**
 * Class ModrinthAPIClient
 *
 * @description This class is the main entry point for the Modrinth API client.
 * @package Aternos\ModrinthApi\Client
 */
class ModrinthAPIClient
{
    protected Configuration $configuration;

    protected ?string $apiToken = null;

    protected ProjectsApi $projects;

    protected VersionsApi $versions;

    protected VersionFilesApi $versionFiles;

    protected UsersApi $users;

    protected TeamsApi $teams;

    protected TagsApi $tags;

    protected MiscApi $misc;

    /**
     * ModrinthAPIClient constructor.
     * @param string|null $apiToken API token used for authentication
     * @param Configuration|null $configuration
     */
    public function __construct(?string $apiToken = null, ?Configuration $configuration = null)
    {
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

        $this->projects = new ProjectsApi(null, $this->configuration);
        $this->versions = new VersionsApi(null, $this->configuration);
        $this->versionFiles = new VersionFilesApi(null, $this->configuration);
        $this->users = new UsersApi(null, $this->configuration);
        $this->teams = new TeamsApi(null, $this->configuration);
        $this->tags = new TagsApi(null, $this->configuration);
        $this->misc = new MiscApi(null, $this->configuration);

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
        }, $this->users->getNotifications($idOrUsername));
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
     */
    public function getLicenses(): array
    {
        return array_map(function (LicenseTag $license): License {
            return new License($this, $license);
        }, $this->tags->licenseList());
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
}