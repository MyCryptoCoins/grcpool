<?php
class GrcPool_Utils {
	
	public static function calculateMag($hostRac,$projRac,$numberOfProjects,$precision) {
		return Utils::truncate(Constants::GRC_MAG_MULTIPLIER*(($hostRac/$projRac)/$numberOfProjects),$precision);
	}
	
	public static function getMinRac($projRac,$numberOfProjects) {
		return Utils::truncate((Constants::MIN_MAG_MAG_FOR_MIN_RAC * $projRac * $numberOfProjects) / Constants::GRC_MAG_MULTIPLIER,2);
	}
	
	public static function getCpidUrl($cpid) {
		return 'http://gridcoinstats.eu/cpid.php?a=view&id='.$cpid;
	}
	
	public static function getTxUrl($tx) {
		return 'http://gridcoinstats.eu/tx.php?id='.$tx;
	}
	
	public static function getGrcAddressUrl($addr) {
		return 'http://gridcoinstats.eu/addresses.php?a=view&id='.$addr;
	}
	
	public static function displayCalculation($str) {
		$str = substr($str,1);
		if (strlen($str) > 200) {
			$str = '<textarea style="width:100%;height:100px;">'.$str.'</textarea>';
		} else {
			$str = str_replace('+','+<br/>',substr($str,1));
		}
		return $str;
	}
	
	public static function getDaemonForEnvironment() {
	
		$daemon = new GridcoinDaemon();
		if (PHP_OS == 'WINNT' || PHP_OS == 'Darwin') {
			$daemon->setPath('C:\PROGRA~2\GridcoinResearch\gridcoinresearchd.exe');
			$daemon->setDataDir('c:\users\brianb~1\appdata\roaming\gridcoinresearch');
		} else {
			$PROPERTY = new Property(dirname(__FILE__).'/../../../properties/grcpool.props.json');
			if ($PROPERTY->get('test')) {
				$daemon->setPath('/usr/bin/gridcoinresearchd');
				$daemon->setDataDir('/home/bgb/.GridcoinResearch');
				$daemon->setTestnet(true);
			} else {
				$daemon->setPath('/usr/bin/gridcoinresearchd');
				$daemon->setDataDir('/home/bgb/.GridcoinResearch');
			}
		}
		return $daemon;
		
	}
	
}