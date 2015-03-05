<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Action' => $baseDir . '/app/models/Action.php',
    'AddPmTableSeeder' => $baseDir . '/app/database/seeds/AddPmTableSeeder.php',
    'AddTestUsersTableSeeder' => $baseDir . '/app/database/seeds/AddTestUsersTableSeeder.php',
    'AdminController' => $baseDir . '/app/controllers/AdminController.php',
    'BaseController' => $baseDir . '/app/controllers/BaseController.php',
    'CreateActionsTable' => $baseDir . '/app/database/migrations/2015_03_03_145509_create_actions_table.php',
    'CreateFavouritesTable' => $baseDir . '/app/database/migrations/2015_02_28_155543_create_favourites_table.php',
    'CreateLastReadTable' => $baseDir . '/app/database/migrations/2015_02_28_155407_create_last_read_table.php',
    'CreatePmRolesTable' => $baseDir . '/app/database/migrations/2015_02_28_155641_create_pm_roles_table.php',
    'CreatePmTagsTable' => $baseDir . '/app/database/migrations/2015_02_28_160511_create_pm_tags_table.php',
    'CreatePmsTable' => $baseDir . '/app/database/migrations/2015_01_28_145354_create_pms_table.php',
    'CreateRolesTable' => $baseDir . '/app/database/migrations/2015_02_28_144922_create_roles_table.php',
    'CreateStatisticsRolesTable' => $baseDir . '/app/database/migrations/2015_02_28_160045_create_statistics_roles_table.php',
    'CreateStatisticsTable' => $baseDir . '/app/database/migrations/2015_02_28_155919_create_statistics_table.php',
    'CreateTagsTable' => $baseDir . '/app/database/migrations/2015_02_28_160349_create_tags_table.php',
    'CreateUserRolesTable' => $baseDir . '/app/database/migrations/2015_02_28_145238_create_user_roles_table.php',
    'CreateUsersTable' => $baseDir . '/app/database/migrations/2015_02_28_143449_create_users_table.php',
    'DatabaseSeeder' => $baseDir . '/app/database/seeds/DatabaseSeeder.php',
    'Datamatrix' => $vendorDir . '/tecnick.com/tcpdf/include/barcodes/datamatrix.php',
    'Favorite' => $baseDir . '/app/models/NotNeededQuestionmark/Favorite.php',
    'GuestController' => $baseDir . '/app/controllers/GuestController.php',
    'IlluminateQueueClosure' => $vendorDir . '/laravel/framework/src/Illuminate/Queue/IlluminateQueueClosure.php',
    'MainController' => $baseDir . '/app/controllers/MainController.php',
    'PDF417' => $vendorDir . '/tecnick.com/tcpdf/include/barcodes/pdf417.php',
    'PMController' => $baseDir . '/app/controllers/PMController.php',
    'Pm' => $baseDir . '/app/models/Pm.php',
    'PmTag' => $baseDir . '/app/models/NotNeededQuestionmark/PmTag.php',
    'QRcode' => $vendorDir . '/tecnick.com/tcpdf/include/barcodes/qrcode.php',
    'Role' => $baseDir . '/app/models/Role.php',
    'SearchController' => $baseDir . '/app/controllers/SearchController.php',
    'SessionHandlerInterface' => $vendorDir . '/symfony/http-foundation/Symfony/Component/HttpFoundation/Resources/stubs/SessionHandlerInterface.php',
    'Smalot\\PdfParser\\Document' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Document.php',
    'Smalot\\PdfParser\\Element' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element.php',
    'Smalot\\PdfParser\\Element\\ElementArray' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementArray.php',
    'Smalot\\PdfParser\\Element\\ElementBoolean' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementBoolean.php',
    'Smalot\\PdfParser\\Element\\ElementDate' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementDate.php',
    'Smalot\\PdfParser\\Element\\ElementHexa' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementHexa.php',
    'Smalot\\PdfParser\\Element\\ElementMissing' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementMissing.php',
    'Smalot\\PdfParser\\Element\\ElementName' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementName.php',
    'Smalot\\PdfParser\\Element\\ElementNull' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementNull.php',
    'Smalot\\PdfParser\\Element\\ElementNumeric' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementNumeric.php',
    'Smalot\\PdfParser\\Element\\ElementString' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementString.php',
    'Smalot\\PdfParser\\Element\\ElementStruct' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementStruct.php',
    'Smalot\\PdfParser\\Element\\ElementXRef' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Element/ElementXRef.php',
    'Smalot\\PdfParser\\Encoding' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Encoding.php',
    'Smalot\\PdfParser\\Encoding\\ISOLatin1Encoding' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Encoding/ISOLatin1Encoding.php',
    'Smalot\\PdfParser\\Encoding\\ISOLatin9Encoding' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Encoding/ISOLatin9Encoding.php',
    'Smalot\\PdfParser\\Encoding\\MacRomanEncoding' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Encoding/MacRomanEncoding.php',
    'Smalot\\PdfParser\\Encoding\\StandardEncoding' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Encoding/StandardEncoding.php',
    'Smalot\\PdfParser\\Encoding\\WinAnsiEncoding' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Encoding/WinAnsiEncoding.php',
    'Smalot\\PdfParser\\Font' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Font.php',
    'Smalot\\PdfParser\\Font\\FontCIDFontType0' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Font/FontCIDFontType0.php',
    'Smalot\\PdfParser\\Font\\FontCIDFontType2' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Font/FontCIDFontType2.php',
    'Smalot\\PdfParser\\Font\\FontTrueType' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Font/FontTrueType.php',
    'Smalot\\PdfParser\\Font\\FontType0' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Font/FontType0.php',
    'Smalot\\PdfParser\\Font\\FontType1' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Font/FontType1.php',
    'Smalot\\PdfParser\\Header' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Header.php',
    'Smalot\\PdfParser\\Object' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Object.php',
    'Smalot\\PdfParser\\Page' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Page.php',
    'Smalot\\PdfParser\\Pages' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Pages.php',
    'Smalot\\PdfParser\\Parser' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Parser.php',
    'Smalot\\PdfParser\\Tests\\Units\\Document' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Document.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementArray' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementArray.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementBoolean' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementBoolean.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementDate' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementDate.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementHexa' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementHexa.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementMissing' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementMissing.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementName' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementName.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementNull' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementNull.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementNumeric' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementNumeric.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementString' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementString.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementStruct' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementStruct.php',
    'Smalot\\PdfParser\\Tests\\Units\\Element\\ElementXRef' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Element/ElementXRef.php',
    'Smalot\\PdfParser\\Tests\\Units\\Font' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Font.php',
    'Smalot\\PdfParser\\Tests\\Units\\Header' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Header.php',
    'Smalot\\PdfParser\\Tests\\Units\\Object' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Object.php',
    'Smalot\\PdfParser\\Tests\\Units\\Page' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Page.php',
    'Smalot\\PdfParser\\Tests\\Units\\Parser' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/Tests/Units/Parser.php',
    'Smalot\\PdfParser\\XObject\\Form' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/XObject/Form.php',
    'Smalot\\PdfParser\\XObject\\Image' => $baseDir . '/app/controllers/pdfparser-master/src/Smalot/PdfParser/XObject/Image.php',
    'StatisticsController' => $baseDir . '/app/controllers/StatisticsController.php',
    'TCPDF' => $vendorDir . '/tecnick.com/tcpdf/tcpdf.php',
    'TCPDF2DBarcode' => $vendorDir . '/tecnick.com/tcpdf/tcpdf_barcodes_2d.php',
    'TCPDFBarcode' => $vendorDir . '/tecnick.com/tcpdf/tcpdf_barcodes_1d.php',
    'TCPDF_COLORS' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_colors.php',
    'TCPDF_FILTERS' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_filters.php',
    'TCPDF_FONTS' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_fonts.php',
    'TCPDF_FONT_DATA' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_font_data.php',
    'TCPDF_IMAGES' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_images.php',
    'TCPDF_IMPORT' => $vendorDir . '/tecnick.com/tcpdf/tcpdf_import.php',
    'TCPDF_PARSER' => $vendorDir . '/tecnick.com/tcpdf/tcpdf_parser.php',
    'TCPDF_STATIC' => $vendorDir . '/tecnick.com/tcpdf/include/tcpdf_static.php',
    'Tag' => $baseDir . '/app/models/Tag.php',
    'TagController' => $baseDir . '/app/controllers/TagContoller.php',
    'TestCase' => $baseDir . '/app/tests/TestCase.php',
    'TestController' => $baseDir . '/app/controllers/TestController.php',
    'User' => $baseDir . '/app/models/User.php',
    'UserController' => $baseDir . '/app/controllers/UserController.php',
    'UserRoles' => $baseDir . '/app/models/NotNeededQuestionmark/UserRoles.php',
    'Whoops\\Module' => $vendorDir . '/filp/whoops/src/deprecated/Zend/Module.php',
    'Whoops\\Provider\\Zend\\ExceptionStrategy' => $vendorDir . '/filp/whoops/src/deprecated/Zend/ExceptionStrategy.php',
    'Whoops\\Provider\\Zend\\RouteNotFoundStrategy' => $vendorDir . '/filp/whoops/src/deprecated/Zend/RouteNotFoundStrategy.php',
);
