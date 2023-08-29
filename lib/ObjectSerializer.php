<?php
/**
 * ObjectSerializer
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Labrinth
 *
 * ## Authentication This API uses personal access tokens tied to a user account for authentication. The token is in the `Authorization` header of the request.  Example: ``` Authorization: mrp_RNtLRSPmGj2pd1v1ubi52nX7TJJM9sznrmwhAuj511oe4t1jAqAQ3D6Wc8Ic ```  You do not need a token for most requests. Generally speaking, only the following types of requests require a token: - those which create data (such as version creation) - those which modify data (such as editing a project) - those which access private data (such as draft projects, notifications, emails, and payout data)  Applications interacting with the authenticated API should have the user generate a personal access token from [their user settings](https://modrinth.com/settings/account). Each request requiring authentication has a certain scope. For example, to view the email of the user being requested, the token must have the `USER_READ_EMAIL` scope. You can find the list of available scopes [on GitHub](https://github.com/modrinth/labrinth/blob/master/src/models/pats.rs#L15). Making a request with an invalid scope will return a 401 error.  Please note that certain scopes and requests cannot be completed with a personal access token. For example, deleting a user account can only be done through Modrinth's frontend.  For backwards compatibility purposes, some types of GitHub tokens also work for authenticating a user with Modrinth's API, granting all scopes. **We urge any application still using GitHub tokens to start using personal access tokens for security and reliability purposes.** GitHub tokens will cease to function to authenticate with Modrinth's API as soon as version 3 of the API is made generally available.  ## Cross-Origin Resource Sharing This API features Cross-Origin Resource Sharing (CORS) implemented in compliance with the [W3C spec](https://www.w3.org/TR/cors/). This allows for cross-domain communication from the browser. All responses have a wildcard same-origin which makes them completely public and accessible to everyone, including any code on any site.  ## Identifiers The majority of items you can interact with in the API have a unique eight-digit base62 ID. Projects, versions, users, threads, teams, and reports all use this same way of identifying themselves. Version files use the sha1 or sha512 file hashes as identifiers.  Each project and user has a friendlier way of identifying them; slugs and usernames, respectively. While unique IDs are constant, slugs and usernames can change at any moment. If you want to store something in the long term, it is recommended to use the unique ID.  ## Ratelimits The API has a ratelimit defined per IP. Limits and remaining amounts are given in the response headers. - `X-Ratelimit-Limit`: the maximum number of requests that can be made in a minute - `X-Ratelimit-Remaining`: the number of requests remaining in the current ratelimit window - `X-Ratelimit-Reset`: the time in seconds until the ratelimit window resets  Ratelimits are the same no matter whether you use a token or not. The ratelimit is currently 300 requests per minute. If you have a use case requiring a higher limit, please [contact us](mailto:admin@modrinth.com).  ## User Agents To access the Modrinth API, you **must** use provide a uniquely-identifying `User-Agent` header. Providing a user agent that only identifies your HTTP client library (such as \"okhttp/4.9.3\") increases the likelihood that we will block your traffic. It is recommended, but not required, to include contact information in your user agent. This allows us to contact you if we would like a change in your application's behavior without having to block your traffic. - Bad: `User-Agent: okhttp/4.9.3` - Good: `User-Agent: project_name` - Better: `User-Agent: github_username/project_name/1.56.0` - Best: `User-Agent: github_username/project_name/1.56.0 (launcher.com)` or `User-Agent: github_username/project_name/1.56.0 (contact@launcher.com)`  ## Versioning Modrinth follows a simple pattern for its API versioning. In the event of a breaking API change, the API version in the URL path is bumped, and migration steps will be published [on the migrations page](/docs/migrations/information).  When an API is no longer the current one, it will immediately be considered deprecated. No more support will be provided for API versions older than the current one. It will be kept for some time, but this amount of time is not certain.  We will exercise various tactics to get people to update their implementation of our API. One example is by adding something like `STOP USING THIS API` to various data returned by the API.  Once an API version is completely deprecated, it will permanently return a 410 error. Please ensure your application handles these 410 errors.
 *
 * The version of the OpenAPI document: v2.7.0/ec80c2b
 * Contact: support@modrinth.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 7.0.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Aternos\ModrinthApi;

use GuzzleHttp\Psr7\Utils;
use Aternos\ModrinthApi\Model\ModelInterface;

/**
 * ObjectSerializer Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ObjectSerializer
{
    /** @var string */
    private static $dateTimeFormat = \DateTime::ATOM;

    /**
     * Change the date format
     *
     * @param string $format   the new date format to use
     */
    public static function setDateTimeFormat($format)
    {
        self::$dateTimeFormat = $format;
    }

    /**
     * Serialize data
     *
     * @param mixed  $data   the data to serialize
     * @param string $type   the OpenAPIToolsType of the data
     * @param string $format the format of the OpenAPITools type of the data
     *
     * @return scalar|object|array|null serialized form of $data
     */
    public static function sanitizeForSerialization($data, $type = null, $format = null)
    {
        if (is_scalar($data) || null === $data) {
            return $data;
        }

        if ($data instanceof \DateTime) {
            return ($format === 'date') ? $data->format('Y-m-d') : $data->format(self::$dateTimeFormat);
        }

        if (is_array($data)) {
            foreach ($data as $property => $value) {
                $data[$property] = self::sanitizeForSerialization($value);
            }
            return $data;
        }

        if (is_object($data)) {
            $values = [];
            if ($data instanceof ModelInterface) {
                $formats = $data::openAPIFormats();
                foreach ($data::openAPITypes() as $property => $openAPIType) {
                    $getter = $data::getters()[$property];
                    $value = $data->$getter();
                    if ($value !== null && !in_array($openAPIType, ['\DateTime', '\SplFileObject', 'array', 'bool', 'boolean', 'byte', 'float', 'int', 'integer', 'mixed', 'number', 'object', 'string', 'void'], true)) {
                        $callable = [$openAPIType, 'getAllowableEnumValues'];
                        if (is_callable($callable)) {
                            /** array $callable */
                            $allowedEnumTypes = $callable();
                            if (!in_array($value, $allowedEnumTypes, true)) {
                                $imploded = implode("', '", $allowedEnumTypes);
                                throw new \InvalidArgumentException("Invalid value for enum '$openAPIType', must be one of: '$imploded'");
                            }
                        }
                    }
                    if (($data::isNullable($property) && $data->isNullableSetToNull($property)) || $value !== null) {
                        $values[$data::attributeMap()[$property]] = self::sanitizeForSerialization($value, $openAPIType, $formats[$property]);
                    }
                }
            } else {
                foreach($data as $property => $value) {
                    $values[$property] = self::sanitizeForSerialization($value);
                }
            }
            return (object)$values;
        } else {
            return (string)$data;
        }
    }

    /**
     * Sanitize filename by removing path.
     * e.g. ../../sun.gif becomes sun.gif
     *
     * @param string $filename filename to be sanitized
     *
     * @return string the sanitized filename
     */
    public static function sanitizeFilename($filename)
    {
        if (preg_match("/.*[\/\\\\](.*)$/", $filename, $match)) {
            return $match[1];
        } else {
            return $filename;
        }
    }

    /**
     * Shorter timestamp microseconds to 6 digits length.
     *
     * @param string $timestamp Original timestamp
     *
     * @return string the shorten timestamp
     */
    public static function sanitizeTimestamp($timestamp)
    {
        if (!is_string($timestamp)) return $timestamp;

        return preg_replace('/(:\d{2}.\d{6})\d*/', '$1', $timestamp);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the path, by url-encoding.
     *
     * @param string $value a string which will be part of the path
     *
     * @return string the serialized object
     */
    public static function toPathValue($value)
    {
        return rawurlencode(self::toString($value));
    }

    /**
     * Checks if a value is empty, based on its OpenAPI type.
     *
     * @param mixed  $value
     * @param string $openApiType
     *
     * @return bool true if $value is empty
     */
    private static function isEmptyValue($value, string $openApiType): bool
    {
        # If empty() returns false, it is not empty regardless of its type.
        if (!empty($value)) {
            return false;
        }

        # Null is always empty, as we cannot send a real "null" value in a query parameter.
        if ($value === null) {
            return true;
        }

        switch ($openApiType) {
            # For numeric values, false and '' are considered empty.
            # This comparison is safe for floating point values, since the previous call to empty() will
            # filter out values that don't match 0.
            case 'int':
            case 'integer':
                return $value !== 0;

            case 'number':
            case 'float':
                return $value !== 0 && $value !== 0.0;

            # For boolean values, '' is considered empty
            case 'bool':
            case 'boolean':
                return !in_array($value, [false, 0], true);

            # For all the other types, any value at this point can be considered empty.
            default:
                return true;
        }
    }

    /**
     * Take query parameter properties and turn it into an array suitable for
     * native http_build_query or GuzzleHttp\Psr7\Query::build.
     *
     * @param mixed  $value       Parameter value
     * @param string $paramName   Parameter name
     * @param string $openApiType OpenAPIType eg. array or object
     * @param string $style       Parameter serialization style
     * @param bool   $explode     Parameter explode option
     * @param bool   $required    Whether query param is required or not
     *
     * @return array
     */
    public static function toQueryValue(
        $value,
        string $paramName,
        string $openApiType = 'string',
        string $style = 'form',
        bool $explode = true,
        bool $required = true
    ): array {

        # Check if we should omit this parameter from the query. This should only happen when:
        #  - Parameter is NOT required; AND
        #  - its value is set to a value that is equivalent to "empty", depending on its OpenAPI type. For
        #    example, 0 as "int" or "boolean" is NOT an empty value.
        if (self::isEmptyValue($value, $openApiType)) {
            if ($required) {
                return ["{$paramName}" => ''];
            } else {
                return [];
            }
        }

        # Handle DateTime objects in query
        if($openApiType === "\\DateTime" && $value instanceof \DateTime) {
            return ["{$paramName}" => $value->format(self::$dateTimeFormat)];
        }

        $query = [];
        $value = (in_array($openApiType, ['object', 'array'], true)) ? (array)$value : $value;

        // since \GuzzleHttp\Psr7\Query::build fails with nested arrays
        // need to flatten array first
        $flattenArray = function ($arr, $name, &$result = []) use (&$flattenArray, $style, $explode) {
            if (!is_array($arr)) return $arr;

            foreach ($arr as $k => $v) {
                $prop = ($style === 'deepObject') ? $prop = "{$name}[{$k}]" : $k;

                if (is_array($v)) {
                    $flattenArray($v, $prop, $result);
                } else {
                    if ($style !== 'deepObject' && !$explode) {
                        // push key itself
                        $result[] = $prop;
                    }
                    $result[$prop] = $v;
                }
            }
            return $result;
        };

        $value = $flattenArray($value, $paramName);

        if ($openApiType === 'object' && ($style === 'deepObject' || $explode)) {
            return $value;
        }

        if ('boolean' === $openApiType && is_bool($value)) {
            $value = self::convertBoolToQueryStringFormat($value);
        }

        // handle style in serializeCollection
        $query[$paramName] = ($explode) ? $value : self::serializeCollection((array)$value, $style);

        return $query;
    }

    /**
     * Convert boolean value to format for query string.
     *
     * @param bool $value Boolean value
     *
     * @return int|string Boolean value in format
     */
    public static function convertBoolToQueryStringFormat(bool $value)
    {
        if (Configuration::BOOLEAN_FORMAT_STRING == Configuration::getDefaultConfiguration()->getBooleanFormatForQueryString()) {
            return $value ? 'true' : 'false';
        }

        return (int) $value;
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the header. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     *
     * @param string $value a string which will be part of the header
     *
     * @return string the header string
     */
    public static function toHeaderValue($value)
    {
        $callable = [$value, 'toHeaderValue'];
        if (is_callable($callable)) {
            return $callable();
        }

        return self::toString($value);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the http body (form parameter). If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     *
     * @param string|\SplFileObject $value the value of the form parameter
     *
     * @return string the form string
     */
    public static function toFormValue($value)
    {
        if ($value instanceof \SplFileObject) {
            return $value->getRealPath();
        } else {
            return self::toString($value);
        }
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the parameter. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     * If it's a boolean, convert it to "true" or "false".
     *
     * @param string|bool|\DateTime $value the value of the parameter
     *
     * @return string the header string
     */
    public static function toString($value)
    {
        if ($value instanceof \DateTime) { // datetime in ISO8601 format
            return $value->format(self::$dateTimeFormat);
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } else {
            return (string) $value;
        }
    }

    /**
     * Serialize an array to a string.
     *
     * @param array  $collection                 collection to serialize to a string
     * @param string $style                      the format use for serialization (csv,
     * ssv, tsv, pipes, multi)
     * @param bool   $allowCollectionFormatMulti allow collection format to be a multidimensional array
     *
     * @return string
     */
    public static function serializeCollection(array $collection, $style, $allowCollectionFormatMulti = false)
    {
        if ($allowCollectionFormatMulti && ('multi' === $style)) {
            // http_build_query() almost does the job for us. We just
            // need to fix the result of multidimensional arrays.
            return preg_replace('/%5B[0-9]+%5D=/', '=', http_build_query($collection, '', '&'));
        }
        switch ($style) {
            case 'pipeDelimited':
            case 'pipes':
                return implode('|', $collection);

            case 'tsv':
                return implode("\t", $collection);

            case 'spaceDelimited':
            case 'ssv':
                return implode(' ', $collection);

            case 'simple':
            case 'csv':
                // Deliberate fall through. CSV is default format.
            default:
                return implode(',', $collection);
        }
    }

    /**
     * Deserialize a JSON string into an object
     *
     * @param mixed    $data          object or primitive to be deserialized
     * @param string   $class         class name is passed as a string
     * @param string[] $httpHeaders   HTTP headers
     * @param string   $discriminator discriminator if polymorphism is used
     *
     * @return object|array|null a single or an array of $class instances
     */
    public static function deserialize($data, $class, $httpHeaders = null)
    {
        if (null === $data) {
            return null;
        }

        if (strcasecmp(substr($class, -2), '[]') === 0) {
            $data = is_string($data) ? json_decode($data) : $data;

            if (!is_array($data)) {
                throw new \InvalidArgumentException("Invalid array '$class'");
            }

            $subClass = substr($class, 0, -2);
            $values = [];
            foreach ($data as $key => $value) {
                $values[] = self::deserialize($value, $subClass, null);
            }
            return $values;
        }

        if (preg_match('/^(array<|map\[)/', $class)) { // for associative array e.g. array<string,int>
            $data = is_string($data) ? json_decode($data) : $data;
            settype($data, 'array');
            $inner = substr($class, 4, -1);
            $deserialized = [];
            if (strrpos($inner, ",") !== false) {
                $subClass_array = explode(',', $inner, 2);
                $subClass = $subClass_array[1];
                foreach ($data as $key => $value) {
                    $deserialized[$key] = self::deserialize($value, $subClass, null);
                }
            }
            return $deserialized;
        }

        if ($class === 'object') {
            settype($data, 'array');
            return $data;
        } elseif ($class === 'mixed') {
            settype($data, gettype($data));
            return $data;
        }

        if ($class === '\DateTime') {
            // Some APIs return an invalid, empty string as a
            // date-time property. DateTime::__construct() will return
            // the current time for empty input which is probably not
            // what is meant. The invalid empty string is probably to
            // be interpreted as a missing field/value. Let's handle
            // this graceful.
            if (!empty($data)) {
                try {
                    return new \DateTime($data);
                } catch (\Exception $exception) {
                    // Some APIs return a date-time with too high nanosecond
                    // precision for php's DateTime to handle.
                    // With provided regexp 6 digits of microseconds saved
                    return new \DateTime(self::sanitizeTimestamp($data));
                }
            } else {
                return null;
            }
        }

        if ($class === '\SplFileObject') {
            $data = Utils::streamFor($data);

            /** @var \Psr\Http\Message\StreamInterface $data */

            // determine file name
            if (
                is_array($httpHeaders)
                && array_key_exists('Content-Disposition', $httpHeaders) 
                && preg_match('/inline; filename=[\'"]?([^\'"\s]+)[\'"]?$/i', $httpHeaders['Content-Disposition'], $match)
            ) {
                $filename = Configuration::getDefaultConfiguration()->getTempFolderPath() . DIRECTORY_SEPARATOR . self::sanitizeFilename($match[1]);
            } else {
                $filename = tempnam(Configuration::getDefaultConfiguration()->getTempFolderPath(), '');
            }

            $file = fopen($filename, 'w');
            while ($chunk = $data->read(200)) {
                fwrite($file, $chunk);
            }
            fclose($file);

            return new \SplFileObject($filename, 'r');
        }

        /** @psalm-suppress ParadoxicalCondition */
        if (in_array($class, ['\DateTime', '\SplFileObject', 'array', 'bool', 'boolean', 'byte', 'float', 'int', 'integer', 'mixed', 'number', 'object', 'string', 'void'], true)) {
            settype($data, $class);
            return $data;
        }


        if (method_exists($class, 'getAllowableEnumValues')) {
            if (!in_array($data, $class::getAllowableEnumValues(), true)) {
                $imploded = implode("', '", $class::getAllowableEnumValues());
                throw new \InvalidArgumentException("Invalid value for enum '$class', must be one of: '$imploded'");
            }
            return $data;
        } else {
            $data = is_string($data) ? json_decode($data) : $data;

            if (is_array($data)) {
                $data = (object)$data;
            }

            // If a discriminator is defined and points to a valid subclass, use it.
            $discriminator = $class::DISCRIMINATOR;
            if (!empty($discriminator) && isset($data->{$discriminator}) && is_string($data->{$discriminator})) {
                $subclass = '\Aternos\ModrinthApi\Model\\' . $data->{$discriminator};
                if (is_subclass_of($subclass, $class)) {
                    $class = $subclass;
                }
            }

            /** @var ModelInterface $instance */
            $instance = new $class();
            foreach ($instance::openAPITypes() as $property => $type) {
                $propertySetter = $instance::setters()[$property];

                if (!isset($propertySetter)) {
                    continue;
                }

                if (!isset($data->{$instance::attributeMap()[$property]})) {
                    if ($instance::isNullable($property)) {
                        $instance->$propertySetter(null);
                    }

                    continue;
                }

                if (isset($data->{$instance::attributeMap()[$property]})) {
                    $propertyValue = $data->{$instance::attributeMap()[$property]};
                    $instance->$propertySetter(self::deserialize($propertyValue, $type, null));
                }
            }
            return $instance;
        }
    }

    /**
     * Native `http_build_query` wrapper.
     * @see https://www.php.net/manual/en/function.http-build-query
     *
     * @param array|object $data           May be an array or object containing properties.
     * @param string       $numeric_prefix If numeric indices are used in the base array and this parameter is provided, it will be prepended to the numeric index for elements in the base array only.
     * @param string|null  $arg_separator  arg_separator.output is used to separate arguments but may be overridden by specifying this parameter.
     * @param int          $encoding_type  Encoding type. By default, PHP_QUERY_RFC1738.
     *
     * @return string
     */
    public static function buildQuery(
        $data,
        string $numeric_prefix = '',
        ?string $arg_separator = null,
        int $encoding_type = \PHP_QUERY_RFC3986
    ): string {
        return \GuzzleHttp\Psr7\Query::build($data, $encoding_type);
    }
}
