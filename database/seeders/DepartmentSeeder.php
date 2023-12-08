<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department')->insert(
            [
            ['name' => "Anatomy"],
            ['name' => "Biochemistry"],
            ['name' => "Physiology"],
            ['name' => "Pathology"],
            ['name' => "Pharmacology"],
            ['name' => "Community Medicine"],
            ['name' => "Forensic Medicine"],
            ['name' => "Medical Education"],
            ['name' => "Allied Health Sciences"],
            ['name' => "Administration"],
            ['name' => "IT"],
            ['name' => "Finance"],
            ['name' => "Transport"],
            ['name' => "Students Affairs"],
            ['name' => "Examination"],
            ['name' => "Library"],
            ['name' => "Nursing College"],
            ['name' => "Research & Development"],
            ['name' => "People & Organisation"],
            ['name' => "Physiotherapy (DPT)"],
            ['name' => "Anesthesia"],
            ['name' => "Dermatology"],
            ['name' => "ENT"],
            ['name' => "Accident and Emergency"],
            ['name' => "General Surgery"],
            ['name' => "Medicine"],
            ['name' => "Obs & Gynae"],
            ['name' => "Ophthalmology"],
            ['name' => "Orthopedic Surgery"],
            ['name' => "Pediatrics"],
            ['name' => "Psychiatry"],
            ['name' => "Urology"],
            ['name' => "BMT"],
            ['name' => "ONCOLOGY"],
            ['name' => "Diagnostic LAB"],
            ['name' => "Radiology"],
            ['name' => "Pharmacy"],
            ['name' => "Nursing"],
            ['name' => "PSD"],
            ['name' => "FNSD"],
            ['name' => "Engineering"],
            ['name' => "Supply Chain"],
            ['name' => "Marketing & Communication"],
            ['name' => "House Job"],
            ['name' => "Marketing & Business Development"],
            ['name' => "Business Development and Corporate Billing"],
            ['name' => "ICU"],
            ['name' => "Quality Assurance"],
            ['name' => "MSA"],
            ['name' => "Infection Control"],
            ['name' => "Medical Record"],
            ['name' => "Admission & Discharge"],
            ['name' => "Dialysis Unit"],
            ['name' => "Gynae OT"],
            ['name' => "Management"],
            ['name' => "ANTH"],
            ['name' => "IMDC"],
            ]);
    }
}
?>