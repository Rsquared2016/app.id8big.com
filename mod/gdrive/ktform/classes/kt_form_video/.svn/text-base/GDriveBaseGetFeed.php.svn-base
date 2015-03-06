<?php

/*
 * This is a class from izap videos, with some modifications to be used into gdrive_ktform.
 * Thank you Izap Guys. :)
 */


/**
 * iZAP izap_videos
 *
 * @package Elgg videotizer, by iZAP Web Solutions.
 * @license GNU Public License version 3
 * @Contact iZAP Team "<support@izap.in>"
 * @Founder Tarun Jangra "<tarun@izap.in>"
 * @link http://www.izap.in/
 * @version 3.62b
 */

class GDriveBaseGetFeed {
  private $url;
  private $type;
  private $feedArray = array();
  private $mainArray = array();
  private $returnArray = array();
  private $fileRead;

  function readFeed($url, $type = '') {
    $this->url = $url;
    $this->type = $type;
    $urltocapture =  new GDriveBaseCurl($this->url) ;
    $urltocapture->setopt(CURLOPT_GET, true) ;
    $this->fileRead = $urltocapture->exec();
    //c($this->fileRead);exit;
    if(empty($this->fileRead) or !$this->fileRead)
      return 101;

    $ext = new gdrive_btext();
    $this->feedArray = $ext->xml2array($this->fileRead);
//      c($this->feedArray);
//      exit;
    switch($this->type) {
      case 'youtube':
        return $this->youtube();
        break;
      case 'vimeo':
        return $this->vimeo();
        break;
      case 'veoh':
        return $this->veoh();
        break;
      default:
        return FALSE;
        break;
    }
  }

  function youtube() {
    $this->mainArray = $this->feedArray['entry']['media:group'];
    if(empty($this->mainArray))
      return 101;

    $this->returnArray['title'] = $this->mainArray['media:title'];
    $this->returnArray['description'] = $this->mainArray['media:description'];
    $this->returnArray['videoThumbnail'] = $this->mainArray['media:thumbnail']['0_attr']['url'];
    $this->returnArray['videoSrc'] = $this->mainArray['media:content_attr']['url'];
    if(empty($this->returnArray['videoSrc'])) {
      $this->returnArray['videoSrc'] = $this->mainArray['media:content']['0_attr']['url'];
    }
    $this->returnArray['videoTags'] = $this->mainArray['media:keywords'];

    // if still empty videoSrc, then test if it is a restricted video
    if(!empty ($this->feedArray['entry']['app:control']['yt:state'])) {
      $this->returnArray['error'] = $this->feedArray['entry']['app:control']['yt:state'];
    }
    return $this->returnArray;
  }

  function vimeo() {
    $this->mainArray = unserialize($this->fileRead);
    $this->mainArray = $this->mainArray[0];
    if(empty($this->mainArray))
      return 101;

    $this->returnArray['title'] = $this->mainArray['title'];
    $this->returnArray['description'] = $this->mainArray['caption'];
    $this->returnArray['videoThumbnail'] = $this->mainArray['thumbnail_medium'];
    $this->returnArray['videoSrc'] = 'http://vimeo.com/moogaloop.swf?clip_id='.$this->mainArray['clip_id'].'&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1';
    $this->returnArray['videoTags'] = $this->mainArray['tags'];

    return $this->returnArray;
  }

  function veoh() {
    if(isset($this->feedArray['rsp']['errorList']['error_attr']['aowPermalink'])) {
      return 102;
    }

    $this->mainArray = $this->feedArray['rsp']['videoList']['video_attr'];
    if(empty($this->mainArray))
      return 101;

    $this->returnArray['title'] = $this->mainArray['title'];
    $this->returnArray['description'] = $this->mainArray['description'];
    $this->returnArray['videoThumbnail'] = ($this->mainArray['fullHighResvideoPath']) ? $this->mainArray['fullHighResvideoPath'] : $this->mainArray['highResvideo'];
    $this->returnArray['videoSrc'] = 'http://www.veoh.com/veohplayer.swf?permalinkId=' . $this->mainArray['permalinkId'] . '&player=videodetailsembedded';
    $this->returnArray['videoTags'] = str_replace(" ", ",", $this->mainArray['tags']);

    return $this->returnArray;
  }
}