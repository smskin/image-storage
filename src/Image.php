<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 14:03
 */

namespace SMSkin\ImageStorage;

/**
 * Class ImageModel
 * Not official documentation https://stackoverflow.com/questions/25148567/list-of-all-the-app-engine-images-service-get-serving-url-uri-options
 *
 * @package SMSkin\ImageStorage
 */
class Image
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var array 
     */
    protected $params = [];

    /**
     * @param string $url
     * @return Image
     */
    final public function setUrl(string $url): Image
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param array $params
     * @return Image
     */
    final public function setParams(array $params): Image
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return string
     */
    final public function __toString(): string
    {
        if (!count($this->params)){
            $this->params['s'] = 's0';
        }
        return $this->url.'='.implode('-',$this->params);
    }

    /**
     * @return Image
     */
    final public function reset(): Image
    {
        $this->params = [];
        return $this;
    }

    final public function size(int $size): Image
    {
        $this->params['size'] = 's'.$size;
        return $this;
    }

    final public function width(int $width): Image
    {
        $this->params['width'] = 'w'.$width;
        return $this;
    }

    final public function height(int $height): Image
    {
        $this->params['height'] = 'h'.$height;
        return $this;
    }

    final public function crop(): Image
    {
        $this->params['crop_type'] = 'c';
        return $this;
    }

    final public function smartCrop(): Image
    {
        $this->params['crop_type'] = 'p';
        return $this;
    }

    final public function centerCrop(): Image
    {
        $this->params['crop_type'] = 'n';
        return $this;
    }

    final public function smartCropNoClip(): Image
    {
        $this->params['crop_type'] = 'pp';
        return $this;
    }

    final public function smartCropUseFace(): Image
    {
        $this->params['crop_type'] = 'pf';
        return $this;
    }

    final public function circleCrop(): Image
    {
        $this->params['crop_type'] = 'cc';
        return $this;
    }

    final public function imageCrop(): Image
    {
        $this->params['crop_type'] = 'ci';
        return $this;
    }

    final public function looseFaceCrop(): Image
    {
        $this->params['crop_type'] = 'lf';
        return $this;
    }

    final public function stretch(): Image
    {
        $this->params['stretch'] = 's';
        return $this;
    }

    final public function download(): Image
    {
        $this->params['output'] = 'd';
        return $this;
    }

    final public function html(): Image
    {
        $this->params['output'] = 'h';
        return $this;
    }

    final public function preserveAspectRatio(): Image
    {
        $this->params['preserve_aspect_ratio'] = 'pa';
        return $this;
    }

    final public function pad(): Image
    {
        $this->params['pad'] = 'pd';
        return $this;
    }

    final public function borderColor(string $hex): Image
    {
        $this->params['border_color'] = 'c0x'.$hex;
        return $this;
    }

    final public function focalPlane(int $param): Image
    {
        $this->params['focal_plane'] = 'p'.$param;
        return $this;
    }

    final public function rotate(int $param): Image
    {
        $this->params['rotate'] = 'r'.$param;
        return $this;
    }

    final public function skipRefererCheck(): Image
    {
        $this->params['skip_referer_check'] = 'r';
        return $this;
    }

    final public function horizontalFlip(): Image
    {
        $this->params['flip'] = 'fh';
        return $this;
    }

    final public function verticalFlip(): Image
    {
        $this->params['flip'] = 'fv';
        return $this;
    }

    final public function overlay(): Image
    {
        $this->params['overlay'] = 'o';
        return $this;
    }

    final public function encodedObjectId(string $id): Image
    {
        $this->params['encoded_object_id'] = 'o'.$id;
        return $this;
    }

    final public function encodedFrameId(string $id): Image
    {
        $this->params['encoded_frame_id'] = 'j'.$id;
        return $this;
    }

    final public function tileX(int $x): Image
    {
        $this->params['tile_x'] = 'x'.$x;
        return $this;
    }

    final public function tileY(int $y): Image
    {
        $this->params['tile_y'] = 'y'.$y;
        return $this;
    }

    final public function tileZoom(int $zoom): Image
    {
        $this->params['tile_z'] = 'z'.$zoom;
        return $this;
    }

    final public function tileGeneration(): Image
    {
        $this->params['tile_generation'] = 'g';
        return $this;
    }

    final public function forceTileGeneration(): Image
    {
        $this->params['tile_generation'] = 'fg';
        return $this;
    }

    final public function forceTransformation(): Image
    {
        $this->params['force_transformation'] = 'ft';
        return $this;
    }

    final public function expirationTime(int $time): Image
    {
        $this->params['expiration_time'] = 'e'.$time;
        return $this;
    }

    final public function imageFilter(string $filter): Image
    {
        $this->params['image_filter'] = 'f'.$filter;
        return $this;
    }

    final public function killAnimation(): Image
    {
        $this->params['kill_animation'] = 'k';
        return $this;
    }

    final public function focusBlur(int $state): Image
    {
        $this->params['focus_blur'] = 'k'.$state;
        return $this;
    }

    final public function unfiltered(): Image
    {
        $this->params['unfiltered'] = 'u';
        return $this;
    }

    final public function unfilteredWithTransforms(): Image
    {
        $this->params['unfiltered'] = 'ut';
        return $this;
    }

    final public function includeMetadata(): Image
    {
        $this->params['include_metadata'] = 'i';
        return $this;
    }

    final public function includePublicMetadata(): Image
    {
        $this->params['include_metadata'] = 'ip';
        return $this;
    }

    final public function esPortraitApprovedOnly(): Image
    {
        $this->params['es_portrait_approved_only'] = 'a';
        return $this;
    }

    final public function selectFrameInt(int $frame): Image
    {
        $this->params['select_frame_int'] = 'a'.$frame;
        return $this;
    }

    final public function videoFormat(int $format): Image
    {
        $this->params['video_format'] = 'm'.$format;
        return $this;
    }

    final public function videoBegin(int $frame): Image
    {
        $this->params['video_begin'] = 'vb'.$frame;
        return $this;
    }

    final public function videoLength(int $length): Image
    {
        $this->params['video_length'] = 'vl'.$length;
        return $this;
    }

    final public function matchVersion(): Image
    {
        $this->params['match_version'] = 'mv';
        return $this;
    }

    final public function imageDigest(): Image
    {
        $this->params['image_digest'] = 'id';
        return $this;
    }

    final public function internalClient(int $client): Image
    {
        $this->params['internal_client'] = 'ic'.$client;
        return $this;
    }

    final public function bypassTakedown(): Image
    {
        $this->params['bypass_takedown'] = 'b';
        return $this;
    }

    final public function borderSize(int $size): Image
    {
        $this->params['border_size'] = 'b'.$size;
        return $this;
    }

    final public function token(string $token): Image
    {
        $this->params['token'] = 't'.$token;
        return $this;
    }

    final public function versionToken(string $token): Image
    {
        $this->params['version_token'] = 'nt0'.$token;
        return $this;
    }

    final public function requestJpg(): Image
    {
        $this->params['format'] = 'rj';
        return $this;
    }

    final public function requestPng(): Image
    {
        $this->params['format'] = 'rp';
        return $this;
    }

    final public function requestGif(): Image
    {
        $this->params['format'] = 'rg';
        return $this;
    }

    final public function requestWebp(): Image
    {
        $this->params['format'] = 'rw';
        return $this;
    }

    final public function requestWebpUnlessMaybeTransparent(): Image
    {
        $this->params['format'] = 'rwu';
        return $this;
    }

    final public function requestAnimatedWebp(): Image
    {
        $this->params['format'] = 'rwa';
        return $this;
    }

    final public function noWebp(): Image
    {
        $this->params['no_webp'] = 'nw';
        return $this;
    }

    final public function requestH264(): Image
    {
        $this->params['request_h264'] = 'rh';
        return $this;
    }

    final public function noCorrectExifOrientation(): Image
    {
        $this->params['no_correct_exif_orientation'] = 'nc';
        return $this;
    }

    final public function noDefaultImage(): Image
    {
        $this->params['no_default_image'] = 'nd';
        return $this;
    }

    final public function noOverlay(): Image
    {
        $this->params['no_overlay'] = 'no';
        return $this;
    }

    final public function queryString(string $string): Image
    {
        $this->params['query_string'] = 'q'.$string;
        return $this;
    }

    final public function noSilhouette(): Image
    {
        $this->params['no_silhouette'] = 'ns';
        return $this;
    }

    final public function qualityLevel(int $level): Image
    {
        $this->params['quality_level'] = 'l'.$level;
        return $this;
    }

    final public function qualityBucket(int $bucket): Image
    {
        $this->params['quality_bucket'] = 'v'.$bucket;
        return $this;
    }

    final public function noUpscale(): Image
    {
        $this->params['no_upscale'] = 'nu';
        return $this;
    }

    final public function tilePyramidAsProto(): Image
    {
        $this->params['tile_pyramid_as_proto'] = 'pg';
        return $this;
    }

    final public function monogram(): Image
    {
        $this->params['monogram'] = 'mo';
        return $this;
    }

    final public function autoloop(): Image
    {
        $this->params['autoloop'] = 'al';
        return $this;
    }

    final public function imageVersion(int $version): Image
    {
        $this->params['image_version'] = 'iv'.$version;
        return $this;
    }

    final public function pitchDegrees(int $param): Image
    {
        $this->params['pitch_degrees'] = 'pi'.$param;
        return $this;
    }

    final public function yawDegrees(int $param): Image
    {
        $this->params['yaw_degrees'] = 'ya'.$param;
        return $this;
    }

    final public function rollDegrees(int $param): Image
    {
        $this->params['roll_degrees'] = 'ro'.$param;
        return $this;
    }

    final public function fovDegrees(int $param): Image
    {
        $this->params['fov_degrees'] = 'fo'.$param;
        return $this;
    }

    final public function detectFaces(): Image
    {
        $this->params['detect_faces'] = 'df';
        return $this;
    }

    final public function videoMultiFormat(string $format): Image
    {
        $this->params['video_multi_format'] = 'mm'.$format;
        return $this;
    }

    final public function stripGoogleData(): Image
    {
        $this->params['strip_google_data'] = 'sg';
        return $this;
    }

    final public function preserveGoogleData(): Image
    {
        $this->params['preserve_google_data'] = 'gd';
        return $this;
    }

    final public function forceMonogram(): Image
    {
        $this->params['monogram'] = 'fm';
        return $this;
    }

    final public function badge(int $badge): Image
    {
        $this->params['badge'] = 'ba'.$badge;
        return $this;
    }

    final public function borderRadius(int $radius): Image
    {
        $this->params['border_radius'] = 'br'.$radius;
        return $this;
    }

    final public function backgroundColor(string $hex): Image
    {
        $this->params['background_color'] = 'bc0x'.$hex;
        return $this;
    }

    final public function padColor(string $hex): Image
    {
        $this->params['pad_color'] = 'pc0x'.$hex;
        return $this;
    }

    final public function substitutionColor(string $hex): Image
    {
        $this->params['substitution_color'] = 'sc0x'.$hex;
        return $this;
    }

    final public function downloadVideo(): Image
    {
        $this->params['download_video'] = 'dv';
        return $this;
    }

    final public function monogramDogfood(): Image
    {
        $this->params['monogram'] = 'md';
        return $this;
    }

    final public function colorProfile(int $profile){
        $this->params['color_profile'] = 'cp'.$profile;
        return $this;
    }

    final public function stripMetadata(): Image
    {
        $this->params['strip_metadata'] = 'sm';
        return $this;
    }

    final public function faceCropVersion(int $version): Image
    {
        $this->params['face_crop_version'] = 'cv'.$version;
        return $this;
    }
}