<?php

namespace Database\Seeders;

use App\Models\SchoolCertificate;
use Illuminate\Database\Seeder;

class SchoolCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolCertificate::create([
            'template'=>'<p dir=\"rtl\" style=\"text-align: center;\"><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">الجمهورية الجزائرية الديموقراطية الشعبية</span><br /><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">وزارة التربية الوطنية</span></p>\n<p dir=\"rtl\" style=\"text-align: right;\"><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">مديرية التربية لولاية باتنة</span><br /><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">متوسطة الإخوة لمباركية</span><br /><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">الرقم: <strong>#numcert</strong></span></p>\n<h1 dir=\"rtl\" style=\"text-align: center;\"><span style=\"font-size: 36pt; font-family: arial, helvetica, sans-serif;\"><strong>شهادة مدرسية</strong></span></h1>\n<p dir=\"rtl\" style=\"text-align: right;\">&nbsp;</p>\n<p dir=\"rtl\" style=\"text-align: right;\">&nbsp;</p>\n<p dir=\"rtl\" style=\"text-align: right;\"><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">يشهد مدير(ة) المؤسسة أن:</span></p>\n<p dir=\"rtl\" style=\"text-align: right;\"><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">اللقب:<strong> #nom</strong> &nbsp; &nbsp; &nbsp;&nbsp; الإسم: <strong>#prenom</strong></span></p>\n<p dir=\"rtl\" style=\"text-align: right;\"><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">المولود بتاريخ: <strong>#dob</strong> &nbsp;&nbsp;&nbsp;&nbsp; بــ:<strong> #pob</strong></span></p>\n<p dir=\"rtl\" style=\"text-align: right;\"><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">تلميذ(ة) بالمؤسسة في قسم: <strong>#class</strong></span></p>\n<p dir=\"rtl\" style=\"text-align: right;\"><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">السنة الدراسية: <strong>#ay</strong></span></p>\n<p dir=\"rtl\" style=\"text-align: right;\"><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">رقم التسجيل:<strong> #numreg</strong></span></p>\n<p dir=\"rtl\" style=\"text-align: right;\"><br /><span style=\"font-family: \'times new roman\', times, serif;\"><span style=\"font-size: 14pt; font-family: arial, helvetica, sans-serif;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; بــ &nbsp;باتنة &nbsp; &nbsp; يوم: <strong>#</strong></span><strong>date</strong></span><br /><span style=\"font-family: \'times new roman\', times, serif;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></p>'
        ]);
        //
    }
}
