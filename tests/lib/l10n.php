<?php
/**
 * Copyright (c) 2013 Thomas Müller <thomas.mueller@tmit.eu>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

class Test_L10n extends PHPUnit_Framework_TestCase {

	public function testGermanPluralTranslations() {
		$l = new OC_L10N('test');
		$transFile = OC::$SERVERROOT.'/tests/data/l10n/de.php';

		$l->load($transFile);
		$this->assertEquals('1 Datei', (string)$l->n('%n file', '%n files', 1));
		$this->assertEquals('2 Dateien', (string)$l->n('%n file', '%n files', 2));
	}

	public function testRussianPluralTranslations() {
		$l = new OC_L10N('test');
		$transFile = OC::$SERVERROOT.'/tests/data/l10n/ru.php';

		$l->load($transFile);
		$this->assertEquals('1 файл', (string)$l->n('%n file', '%n files', 1));
		$this->assertEquals('2 файла', (string)$l->n('%n file', '%n files', 2));
		$this->assertEquals('6 файлов', (string)$l->n('%n file', '%n files', 6));
		$this->assertEquals('21 файл', (string)$l->n('%n file', '%n files', 21));
		$this->assertEquals('22 файла', (string)$l->n('%n file', '%n files', 22));
		$this->assertEquals('26 файлов', (string)$l->n('%n file', '%n files', 26));

		/*
		  1 file	1 файл	1 папка
		2-4 files	2-4 файла	2-4 папки
		5-20 files	5-20 файлов	5-20 папок
		21 files	21 файл	21 папка
		22-24 files	22-24 файла	22-24 папки
		25-30 files	25-30 файлов	25-30 папок
		etc
		100 files	100 файлов,	100 папок
		1000 files	1000 файлов	1000 папок
		*/
	}

	public function testCzechPluralTranslations() {
		$l = new OC_L10N('test');
		$transFile = OC::$SERVERROOT.'/tests/data/l10n/cs.php';

		$l->load($transFile);
		$this->assertEquals('1 okno', (string)$l->n('%n window', '%n windows', 1));
		$this->assertEquals('2 okna', (string)$l->n('%n window', '%n windows', 2));
		$this->assertEquals('5 oken', (string)$l->n('%n window', '%n windows', 5));
	}

	/**
	 * Issue #4360: Do not call strtotime() on numeric strings.
	 */
	public function testNumericStringToDateTime() {
		$l = new OC_L10N('test');
		$this->assertSame('February 13, 2009 23:31', $l->l('datetime', '1234567890'));
	}

	public function testNumericToDateTime() {
		$l = new OC_L10N('test');
		$this->assertSame('February 13, 2009 23:31', $l->l('datetime', 1234567890));
	}

	public function testLanguageExists() {
		$this->assertTrue(OC_L10N::languageExists('core', 'en')); // en should always be available
		$this->assertTrue(OC_L10N::languageExists('files', 'zh_TW')); // /apps/files/l10n/zh_TW.php should exist for this to be true
	}

	public function testCheckPreferenceLanguage() {
		$this->assertFalse(OC_L10N::checkPreferenceLanguage(array('en', 'fr')));
		$this->assertFalse(OC_L10N::checkPreferenceLanguage());
		// Currently we don't test when user is logged in
	}
}
