<?php

// (c) Copyright by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: ParseFileTest.php 78605 2021-07-05 14:54:45Z rjsmelo $

require_once(__DIR__ . '/../../language/File.php');

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;

class Language_FileTest extends TikiTestCase
{
    protected $obj;

    protected $filePath;

    protected function setUp(): void
    {
        $this->filePath = __DIR__ . '/fixtures/language_to_parse_file.php';
        $this->obj = new Language_File($this->filePath);
    }

    public function provider(): array
    {
        return [[[
            'Bytecode Cache' => ['key' => 'Bytecode Cache', 'translated' => false],
            'Used' => ['key' => 'Used', 'translation' => "Usado", 'translated' => true],
             'Available' => ['key' => 'Available', 'translated' => false],
            'Memory' => ['key' => 'Memory', 'translated' => false],
            '%0 enabled' => ['key' => '%0 enabled', 'translation' => '%0 habilitado', 'translated' => true],
            'Features' => ['key' => 'Features', 'translation' => 'Recursos', 'translated' => true],
            'Enable/disable Tiki features here, but configure them elsewhere' => ['key' => 'Enable/disable Tiki features here, but configure them elsewhere', 'translated' => false],
        ]]];
    }

    public function testConstructShouldThrowExceptionForInvalidFile(): void
    {
        $this->expectException('Language_Exception');
        $this->expectExceptionMessage('Path invalidFile does not exist.');
        new Language_File('invalidFile');
    }

    public function testConstructShouldSetFilePath(): void
    {
        $obj = new Language_File($this->filePath);
        $this->assertEquals($this->filePath, $obj->filePath);
    }

    /**
     * @dataProvider provider
     * @param $expectedResult
     */
    public function testParseShouldReturnDataStructureRepresentingLanguageFile($expectedResult): void
    {
        $this->assertEquals($expectedResult, $this->obj->parse());
    }

    public function testParseShouldSetContentLoadedProperty(): void
    {
        $reflectionClass = new ReflectionClass($this->obj);
        $property = $reflectionClass->getProperty('contentLoaded');
        $property->setAccessible(true);

        $this->obj->parse();
        $this->assertTrue($property->getValue($this->obj));
    }

    public function testGetStatsShouldReturnEmptyStats(): void
    {
        $expectedResult = [
            'total' => 0,
            'translated' => 0,
            'untranslated' => 0,
            'percentage' => 0,
        ];

        $root = vfsStream::setup('root');
        $file = new vfsStreamFile('language.php');
        $root->addChild($file);

        $obj = new Language_File(vfsStream::url('root/language.php'));

        $this->assertEquals($expectedResult, $obj->getStats());
    }

    public function testGetStatsShouldReturnLangFileStats(): void
    {
        $expectedResult = [
            'total' => 7,
            'translated' => 3,
            'untranslated' => 4,
            'percentage' => 42.86,
        ];

        $this->assertEquals($expectedResult, $this->obj->getStats());
    }

    /**
     * @dataProvider provider
     * @param $content
     * @throws ReflectionException
     */
    public function testGetStatsShouldNotCallParseIfContentIsAlreadyLoaded($content): void
    {
        $expectedResult = [
            'total' => 7,
            'translated' => 3,
            'untranslated' => 4,
            'percentage' => 42.86,
        ];

        $obj = $this->getMockBuilder('Language_File')
                    ->onlyMethods(['parse'])
                    ->setConstructorArgs([$this->filePath])
                    ->getMock();

        $obj->expects($this->never())->method('parse');

        $reflectionClass = new ReflectionClass($obj);
        $contentProperty = $reflectionClass->getProperty('content');
        $contentProperty->setAccessible(true);
        $contentProperty->setValue($obj, $content);
        $contentLoadedProperty = $reflectionClass->getProperty('contentLoaded');
        $contentLoadedProperty->setAccessible(true);
        $contentLoadedProperty->setValue($obj, true);

        $this->assertEquals($expectedResult, $obj->getStats());
    }

    public function testGetTranslationsShouldReturnEmptyArray(): void
    {
        $root = vfsStream::setup('root');
        $root->addChild(new vfsStreamFile('language.php'));
        $obj = new Language_File(vfsStream::url('root/language.php'));
        $this->assertEquals([], $obj->getTranslations());
    }

    public function testGetTranslationsShouldReturnTranslations(): void
    {
        $expectedResult = [
            "Used" => "Usado",
            "%0 enabled" => "%0 habilitado",
            "Features" => "Recursos",
        ];

        $this->assertEquals($expectedResult, $this->obj->getTranslations());
    }
}
