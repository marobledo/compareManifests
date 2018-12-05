# compareManifests
Based on a GroupID you can compare manifests from different sources with CURL.

It is a php based script. It gets the GroupID on the URL as a Variable.

example: www.example.com/cont.php?grupo=769624

into the curl command you have to use Akamai Pragma Headers

Exit example:

Formato Smooth Streaming
  Manifest:  http://streamingHost.com/multimediav81/plataforma_vod/MP4/201801/WMP4H36648MTCR_full/WMP4H36648MTCR_full_SS.ism/Manifest
  LCDN    : Last-Modified: Fri, 09 Feb 2018 00:07:51 GMT  
  ORIGEN  : Last-Modified: Thu, 22 Mar 2018 00:17:29 GMT
  */It's different the date from LCDN and Origin Server.
   The LCDN streaming  crashes with green macroblocks./*
