<?php

/*
 * This is a class from izap videos, with some modifications to be used into events_ktform.
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

class EventsBaseUrlFeed extends EventsBaseGetFeed {
	private $youtube_api_capture = array('api_location'=>'http://gdata.youtube.com/feeds/api/videos/');
	private $vimeo_api_capture = array('api_location' => 'http://vimeo.com/api/clip/');
	private $veoh_api_capture = array('api_location'=>'http://www.veoh.com/rest/v2/execute.xml?method=veoh.video.findByPermalink','apiKey'=>'CFEDBB8B-59FB-D36B-7435-E4B39C5D39A2');
	private $feed;
	public  $type;
	private $video_id;

	function getSupportedSites() {
		$sites = array(
			'youtube',
			'vimeo',
			//'veoh',
		);
		
		return $sites;
	}
	
	function validateUrl($url = '') {
		$type = '';
		
		if (preg_match('/(http:\/\/)?(www\.)?(youtube\.com\/)(.*)/', $url, $matches)) {
		  $type = 'youtube';
		}elseif (preg_match('/(http:\/\/)?(www\.)?(vimeo\.com\/)(.*)/', $url, $matches)) {
		  $type = 'vimeo';
		}elseif (preg_match('/(http:\/\/)?(www\.)?(veoh\.com\/)(.*)/', $url, $matches)) {
		  $type = 'veoh';
		}
		
		return $type;
	}

	function setUrl($url = '') {

		$this->type = $this->validateUrl($url);

		switch($this->type) {
		  case 'youtube':
			$url_pram = explode("?",$url);
			$url_pram = explode("&",$url_pram[1]);
			$url_pram = explode("=",$url_pram[0]);
			$this->video_id = $url_pram[1];
			$this->feed = array('url' => $this->youtube_api_capture['api_location'].$this->video_id, 'type' => 'youtube');
			break;

		  case 'vimeo':
			$explode_char = '/';
			if(preg_match('/staffpicks#/', $url)) {
			  $explode_char = '#';
			}

			$url_pram = explode($explode_char,$url);
			$this->video_id = sanitise_int(end($url_pram));
			$this->feed = array('url' => $this->vimeo_api_capture['api_location'].$this->video_id.'.php', 'type' => 'vimeo');
			break;

		  case 'veoh':
			$video_id = end(explode("%",$url));
			$this->video_id = substr($video_id, 2);
			$chk = strtolower(substr($this->video_id, 0, 1));
			if($chk != 'v') {
			  $this->video_id = end(explode("/",$url));
			}
			$this->feed = array('url' => $this->veoh_api_capture['api_location'].'&apiKey='.$this->veoh_api_capture['apiKey'].'&permalink='.$this->video_id, 'type' => 'veoh');
			break;

		  default:
			return 103;
			break;
		}

		return $this->capture();
	}
	
	function getVideoIframeUrl($entity) {
		$iframe_urls = array(
			'youtube' => "http://www.youtube.com/embed/<VIDEO_ID>",
			'vimeo' => "http://player.vimeo.com/video/<VIDEO_ID>?title=0&amp;byline=0&amp;portrait=0",
		);
		
		$src = '';
		switch($entity->video_type) {
			case 'youtube':
				$src = $iframe_urls[$entity->video_type];
				$src = str_replace('<VIDEO_ID>', $entity->video_id, $src);
				break;

			case 'vimeo':
				$src = $iframe_urls[$entity->video_type];
				$src = str_replace('<VIDEO_ID>', $entity->video_id, $src);
				break;

			case 'veoh':
				//KTODO: Add veoh url.
				break;

			default:
				return 103;
				break;			
		}
		
		return $src;
	}
	
	  /**
	   * gets the video player according to the video type
	   *
	   * @param int $width width of video player
	   * @param int $height height of video player
	   * @param int $autoPlay autoplay option (1 | 0)
	   * @param string $extraOptions extra options if available
	   * @return HTML complete player code
	   */
	  function getPlayer($entity, $width = 640, $height = 385, $autoPlay = 0, $extraOptions = '') {
		global $CONFIG;
		$html = '';
		switch ($entity->video_type) {
		  case 'youtube':
			$html = "<object width=\"$width\" height=\"$height\"><param name=\"movie\" value=\"{$entity->video_src}&hl=en&fs=1&autoplay={$autoPlay}\"></param><param name=\"wmode\" value=\"transparent\"></param><param name=\"allowFullScreen\" value=\"true\"></param><embed src=\"{$entity->video_src}&hl=en&fs=1&autoplay={$autoPlay} \" type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" width=\"$width\" height=\"$height\" wmode=\"transparent\"></embed></object>";
			break;
		  case 'vimeo':
			$html = "<object width=\"$width\" height=\"$height\"><param name=\"wmode\" value=\"transparent\"></param><param name=\"allowfullscreen\" value=\"true\" /><param name=\"allowscriptaccess\" value=\"always\" /><param name=\"movie\" value=\"{$entity->video_src}&amp;autoplay={$autoPlay}\" /><embed src=\"{$entity->video_src}&amp;autoplay={$autoPlay}\" type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" allowscriptaccess=\"always\" width=\"$width\" height=\"$height\" wmode=\"transparent\"></embed></object>";
			break;
		  case 'veoh':
			$html = "<embed src=\"{$entity->video_src}&videoAutoPlay={$autoPlay}\" allowFullScreen=\"true\" width=\"$width\" height=\"$height\" bgcolor=\"#FFFFFF\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" wmode=\"transparent\"></embed>";
			break;
		}
		return $html;
	  }	

	function capture() {

		$obj= new stdClass;

		$arry = $this->readFeed($this->feed['url'], $this->feed['type']);

		$obj->title = $arry['title'];
		$obj->description = $arry['description'];
		$obj->videoThumbnail = $arry['videoThumbnail'];
		$obj->videoTags = $arry['videoTags'];
		$obj->videoSrc = $arry['videoSrc'];
		if(empty($obj->title) or empty($obj->videoSrc) or empty($obj->videoThumbnail)) {
		  if(!empty($arry['error'])) {
			return $arry['error'];
		  }else {
			return $arry;
		  }
		}
		$obj->fileName = time() . $this->video_id . ".jpg";

		//Get Thumbnail
		$urltocapture =  new EventsBaseCurl($obj->videoThumbnail) ;
		$urltocapture->setopt(CURLOPT_GET, true) ;

		$obj->fileContent = $urltocapture->exec();
		
		$obj->videoId = $this->video_id;

		$obj->videoType = $this->feed['type'];
		//echo "<pre>";print_r($obj);exit;
		return $obj;
	}

}