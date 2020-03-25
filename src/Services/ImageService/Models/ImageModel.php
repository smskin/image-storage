<?php

namespace SMSkin\ImageStorage\Services\ImageService\Models;

use SMSkin\ImageStorage\Services\ImageService\Exceptions\ValidationException;

class ImageModel
{
    public const OUTPUT_FORMAT_DOWNLOAD = 'd';
    public const OUTPUT_FORMAT_HTML = 'h';
    public const OUTPUT_FORMAT_DOWNLOAD_VIDEO = 'dv';

    public const FORMAT_JPG = 'rj'; // forces the resulting image to be JPG
    public const FORMAT_PNG = 'rp'; // forces the resulting image to be PNG
    public const FORMAT_GIF = 'rg'; // forces the resulting image to be GIF
    public const FORMAT_WEBP = 'rw'; // forces the resulting image to be WebP
    public const FORMAT_WEBP_UNLESS_MAYBE_TRANSPARENT = 'rwu';
    public const FORMAT_ANIMATED_WEBP = 'rwa';
    public const FORMAT_H264 = 'rh';

    public const CROP_TYPE_DEFAULT = 'c'; // crops image to provided dimensions
    public const CROP_TYPE_SMART = 'p'; // smart square crop, attempts cropping to faces
    public const CROP_TYPE_CENTER = 'n'; // same as c, but crops from the center
    public const CROP_TYPE_SMART_NO_CLIP = 'pp'; // alternate smart square crop, does not cut off faces (?)
    public const CROP_TYPE_SMART_USE_FACE = 'pf';
    public const CROP_TYPE_CIRCLE = 'cc'; // generates a circularly cropped image
    public const CROP_TYPE_IMAGE = 'ci'; //square crop to smallest of: width, height, or specified =s parameter
    public const CROP_TYPE_LOOSE_FACE = 'lf';

    /**
     * @var string
     */
    public $url;

    /**
     * @var array
     */
    public $params = [];

    public function __construct(string $url, string $format, int $quality)
    {
        $this->url = $url;
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->setFormat($format);
        $this->setQualityLevel($quality);
    }

    /**
     * @param array $params
     * @return ImageModel
     */
    public function setParams(array $params): ImageModel
    {
        $this->params = $params;
        return $this;
    }

    public function getUrl(): string
    {
        if (!count($this->params)){
            $this->params['s'] = 's0';
        }
        return $this->url.'='.implode('-',$this->params);
    }

    public function __toString(): string
    {
        return $this->getUrl();
    }

    public function setSize(int $size): ImageModel
    {
        $this->params['s'] = 's'.$size;
        return $this;
    }

    public function setWidth(int $width): ImageModel
    {
        $this->params['w'] = 'w'.$width;
        return $this;
    }

    public function setHeight(int $height): ImageModel
    {
        $this->params['h'] = 'h'.$height;
        return $this;
    }

    public function preserveAspectRatio(): ImageModel
    {
        $this->params['pa'] = 'pa';
        return $this;
    }

    /**
     * @param string $cropType
     * @return ImageModel
     * @throws ValidationException
     */
    public function crop(string $cropType): ImageModel
    {
        if (!in_array($cropType,[
            self::CROP_TYPE_DEFAULT,
            self::CROP_TYPE_SMART,
            self::CROP_TYPE_CENTER,
            self::CROP_TYPE_SMART_NO_CLIP,
            self::CROP_TYPE_SMART_USE_FACE,
            self::CROP_TYPE_CIRCLE,
            self::CROP_TYPE_IMAGE,
            self::CROP_TYPE_LOOSE_FACE
        ],true)){
            throw new ValidationException('Undefined crop type');
        }

        $this->params['crop'] = $cropType;
        return $this;
    }

    /**
     * @param string $format
     * @return ImageModel
     * @throws ValidationException
     */
    public function setOutputFormat(string $format): ImageModel
    {
        if (!in_array($format,[
            self::OUTPUT_FORMAT_DOWNLOAD,
            self::OUTPUT_FORMAT_HTML,
            self::OUTPUT_FORMAT_DOWNLOAD_VIDEO
        ],true)){
            throw new ValidationException('Undefined output format');
        }

        $this->params['output_format'] = $format;
        return $this;
    }

    public function setTileX(int $x): ImageModel
    {
        $this->params['tile_x'] = 'x'.$x;
        return $this;
    }

    public function setTileY(int $y): ImageModel
    {
        $this->params['tile_y'] = 'y'.$y;
        return $this;
    }

    public function setTileZoom(int $zoom): ImageModel
    {
        $this->params['tile_z'] = 'z'.$zoom;
        return $this;
    }

    public function tileGeneration(): ImageModel
    {
        $this->params['tile_generation'] = 'g';
        return $this;
    }

    public function forceTileGeneration(): ImageModel
    {
        $this->params['tile_generation'] = 'fg';
        return $this;
    }

    public function tilePyramidAsProto(): ImageModel
    {
        $this->params['tile_pyramid_as_proto'] = 'pg';
        return $this;
    }

    public function setBorderSize(int $size): ImageModel
    {
        $this->params['border_size'] = 'b'.$size;
        return $this;
    }

    public function setBorderRadius(int $radius): ImageModel
    {
        $this->params['border_radius'] = 'br'.$radius;
        return $this;
    }

    public function setBorderColor(string $hex): ImageModel
    {
        $this->params['border_color'] = 'c0x'.$hex;
        return $this;
    }

    public function pad(): ImageModel
    {
        $this->params['pd'] = 'pd';
        return $this;
    }

    public function setPadColor(string $hex): ImageModel
    {
        $this->params['pad_color'] = 'pc0x'.$hex;
        return $this;
    }

    public function setBackgroundColor(string $hex): ImageModel
    {
        $this->params['background_color'] = 'bc0x'.$hex;
        return $this;
    }

    public function setFocalPlane(int $param): ImageModel
    {
        $this->params['focal_plane'] = 'p'.$param;
        return $this;
    }

    /**
     * @param int $param
     * @return ImageModel
     * @throws ValidationException
     */
    public function rotate(int $param): ImageModel
    {
        if (!in_array($param,[
            90,
            180,
            270
        ],true)){
            throw new ValidationException('Undefined rotate param');
        }

        $this->params['rotate'] = 'r'.$param;
        return $this;
    }

    public function skipRefererCheck(): ImageModel
    {
        $this->params['skip_referer_check'] = 'r';
        return $this;
    }

    public function horizontalFlip(): ImageModel
    {
        $this->params['flip'] = 'fh';
        return $this;
    }

    public function verticalFlip(): ImageModel
    {
        $this->params['flip'] = 'fv';
        return $this;
    }

    public function overlay(): ImageModel
    {
        $this->params['overlay'] = 'o';
        return $this;
    }

    public function setEncodedObjectId(string $id): ImageModel
    {
        $this->params['encoded_object_id'] = 'o'.$id;
        return $this;
    }

    public function setEncodedFrameId(string $id): ImageModel
    {
        $this->params['encoded_frame_id'] = 'j'.$id;
        return $this;
    }

    public function forceTransformation(): ImageModel
    {
        $this->params['force_transformation'] = 'ft';
        return $this;
    }

    public function setExpirationTime(int $time): ImageModel
    {
        $this->params['expiration_time'] = 'e'.$time;
        return $this;
    }

    public function setImageFilter(string $filter): ImageModel
    {
        $this->params['image_filter'] = 'f'.$filter;
        return $this;
    }

    public function killAnimation(): ImageModel
    {
        $this->params['kill_animation'] = 'k';
        return $this;
    }

    public function setFocusBlur(int $state): ImageModel
    {
        $this->params['focus_blur'] = 'k'.$state;
        return $this;
    }

    public function unfiltered(): ImageModel
    {
        $this->params['unfiltered'] = 'u';
        return $this;
    }

    public function unfilteredWithTransforms(): ImageModel
    {
        $this->params['unfiltered'] = 'ut';
        return $this;
    }

    public function includeMetadata(): ImageModel
    {
        $this->params['include_metadata'] = 'i';
        return $this;
    }

    public function includePublicMetadata(): ImageModel
    {
        $this->params['include_metadata'] = 'ip';
        return $this;
    }

    public function esPortraitApprovedOnly(): ImageModel
    {
        $this->params['es_portrait_approved_only'] = 'a';
        return $this;
    }

    public function setFrameInt(int $frame): ImageModel
    {
        $this->params['set_frame_int'] = 'a'.$frame;
        return $this;
    }

    public function setVideoFormat(int $format): ImageModel
    {
        $this->params['video_format'] = 'm'.$format;
        return $this;
    }

    public function setVideoBegin(int $frame): ImageModel
    {
        $this->params['video_begin'] = 'vb'.$frame;
        return $this;
    }

    public function setVideoLength(int $length): ImageModel
    {
        $this->params['video_length'] = 'vl'.$length;
        return $this;
    }

    public function matchVersion(): ImageModel
    {
        $this->params['match_version'] = 'mv';
        return $this;
    }

    public function imageDigest(): ImageModel
    {
        $this->params['image_digest'] = 'id';
        return $this;
    }

    public function setInternalClient(int $client): ImageModel
    {
        $this->params['internal_client'] = 'ic'.$client;
        return $this;
    }


    public function bypassTakeDown(): ImageModel
    {
        $this->params['bypass_take_down'] = 'b';
        return $this;
    }

    public function setToken(string $token): ImageModel
    {
        $this->params['token'] = 't'.$token;
        return $this;
    }

    public function setVersionToken(string $token): ImageModel
    {
        $this->params['version_token'] = 'nt0'.$token;
        return $this;
    }

    /**
     * @param string $format
     * @return ImageModel
     * @throws ValidationException
     */
    public function setFormat(string $format): ImageModel
    {
        if (!in_array($format,[
            self::FORMAT_JPG,
            self::FORMAT_PNG,
            self::FORMAT_GIF,
            self::FORMAT_WEBP,
            self::FORMAT_WEBP_UNLESS_MAYBE_TRANSPARENT,
            self::FORMAT_ANIMATED_WEBP,
            self::FORMAT_H264
        ])){
            throw new ValidationException('Undefined format');
        }
        $this->params['format'] = $format;
        return $this;
    }

    public function noWebp(): ImageModel
    {
        $this->params['no_webp'] = 'nw';
        return $this;
    }

    public function noCorrectExifOrientation(): ImageModel
    {
        $this->params['no_correct_exif_orientation'] = 'nc';
        return $this;
    }

    public function noDefaultImage(): ImageModel
    {
        $this->params['no_default_image'] = 'nd';
        return $this;
    }

    public function noOverlay(): ImageModel
    {
        $this->params['no_overlay'] = 'no';
        return $this;
    }

    public function setQueryString(string $string): ImageModel
    {
        $this->params['query_string'] = 'q'.$string;
        return $this;
    }

    public function noSilhouette(): ImageModel
    {
        $this->params['no_silhouette'] = 'ns';
        return $this;
    }

    public function setQualityLevel(int $level): ImageModel
    {
        $this->params['quality_level'] = 'l'.$level;
        return $this;
    }

    public function setImageFormatOption(int $state): ImageModel
    {
        $this->params['image_format_option'] = 'v'.$state;
        return $this;
    }

    public function noUpscale(): ImageModel
    {
        $this->params['no_upscale'] = 'nu';
        return $this;
    }

    public function monogram(): ImageModel
    {
        $this->params['monogram'] = 'mo';
        return $this;
    }

    public function forceMonogram(): ImageModel
    {
        $this->params['monogram'] = 'fm';
        return $this;
    }

    public function monogramDogFood(): ImageModel
    {
        $this->params['monogram_dog_food'] = 'md';
        return $this;
    }

    public function autoLoop(): ImageModel
    {
        $this->params['auto_loop'] = 'al';
        return $this;
    }

    public function setImageVersion(int $version): ImageModel
    {
        $this->params['image_version'] = 'iv'.$version;
        return $this;
    }

    public function setPitchDegrees(int $param): ImageModel
    {
        $this->params['pitch_degrees'] = 'pi'.$param;
        return $this;
    }

    public function setYawDegrees(int $param): ImageModel
    {
        $this->params['yaw_degrees'] = 'ya'.$param;
        return $this;
    }

    public function setRollDegrees(int $param): ImageModel
    {
        $this->params['roll_degrees'] = 'ro'.$param;
        return $this;
    }

    public function setFovDegrees(int $param): ImageModel
    {
        $this->params['fov_degrees'] = 'fo'.$param;
        return $this;
    }

    public function detectFaces(): ImageModel
    {
        $this->params['detect_faces'] = 'df';
        return $this;
    }

    public function setVideoMultiFormat(string $format): ImageModel
    {
        $this->params['video_multi_format'] = 'mm'.$format;
        return $this;
    }

    public function stripGoogleData(): ImageModel
    {
        $this->params['strip_google_data'] = 'sg';
        return $this;
    }

    public function preserveGoogleData(): ImageModel
    {
        $this->params['preserve_google_data'] = 'gd';
        return $this;
    }

    public function setBadge(int $badge): ImageModel
    {
        $this->params['badge'] = 'ba'.$badge;
        return $this;
    }

    public function setSubstitutionColor(string $hex): ImageModel
    {
        $this->params['substitution_color'] = 'sc0x'.$hex;
        return $this;
    }

    public function setColorProfile(int $profile): ImageModel
    {
        $this->params['color_profile'] = 'cp'.$profile;
        return $this;
    }

    public function stripMetadata(): ImageModel
    {
        $this->params['strip_metadata'] = 'sm';
        return $this;
    }

    public function setFaceCropVersion(int $version): ImageModel
    {
        $this->params['face_crop_version'] = 'cv'.$version;
        return $this;
    }

    public function getSoftenFilter(int $opacity): string
    {
        return 'Soften=1,100,'.$opacity;
    }

    public function getBoxShadowFilter(int $size, string $hex): string
    {
        return 'Vignette=1,'.$size.',1.4,0,0x'.$hex;
    }

    public function getInvertColorFilter(): string
    {
        return 'Invert=1';
    }

    public function getBlackAndWhiteFilter(): string
    {
        return 'bw=1';
    }
}