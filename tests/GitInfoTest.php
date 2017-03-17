<?php

use eiriksm\GitInfo\GitInfo;

const BOGUS_COMMAND = 'inTheDepthsOfHell';

class GitInfoTest extends \PHPUnit_Framework_TestCase {

  public function testHash() {
    $i = new GitInfo();
    $hash = $i->getShortHash();
    $this->assertNotFalse($hash);
  }

  public function testNoHash() {
    $i = $this->getBadGit();
    $hash = $i->getShortHash();
    $this->assertFalse($hash);
  }

  public function testVersion() {
    $i = new GitInfo();
    $version = $i->getVersion();
    $this->assertNotFalse($version);
  }

  public function testBadVersion() {
    $i = $this->getBadGit();
    $this->assertEquals('dev', $i->getVersion());
  }

  public function testDate() {
    $i = new GitInfo();
    $this->assertNotFalse($i->getDate());
  }

  public function testBadDate() {
    $i = $this->getBadGit();
    $this->assertFalse($i->getDate());
  }

  public function testVersionString() {
    $i = new GitInfo();
    $v = $i->getApplicationVersionString();
    $this->assertNotEquals('v.dev', $v);
  }

  public function testBadVersionString() {
    $i = $this->getBadGit();
    $v = $i->getApplicationVersionString();
    $this->assertEquals('v.dev.', $v);
  }

  private function getBadGit() {
    return new GitInfo(BOGUS_COMMAND);
  }
}
