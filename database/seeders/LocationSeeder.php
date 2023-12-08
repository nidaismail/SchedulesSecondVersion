<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('location')->insert(
            [
            ['location' => "TBD",'capacity' => "0", 'display' => "0",'soundSystem' => "0",'ExamCapacity' => "0"],
            ['location' => "Skill Lab",'capacity' => "0", 'display' => "L & P",'soundSystem' => "N",'ExamCapacity' => "0"],
            ['location' => "Anatomy Lab",'capacity' => "30", 'display' => "",'soundSystem' => "N",'ExamCapacity' => ""],
            ['location' => "Professor Room (Medicine)",'capacity' => "30", 'display' => "L",'soundSystem' => "N",'ExamCapacity' => ""],
            ['location' => "Prof. Room ENT",'capacity' => "15", 'display' => "L",'soundSystem' => "N",'ExamCapacity' => ""],
            ['location' => "Prof.Room Surgery",'capacity' => "25", 'display' => "L",'soundSystem' => "N",'ExamCapacity' => ""],
            ['location' => "Reporting Room",'capacity' => "25", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => "0"],
            //['location' => "Forensic Medicine Lab",'capacity' => "", 'display' => "",'soundSystem' => "N",'ExamCapacity' => ""],
            ['location' => "Pharmacology Lab",'capacity' => "50", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => "20"],
            ['location' => "Surgery Tutorial Room",'capacity' => "25", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => "0"],
            ['location' => "Medicine Tutorial Room",'capacity' => "30", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => "0"],
            ['location' => "Dissection Hall",'capacity' => "88", 'display' => "L & P",'soundSystem' => "Y",'ExamCapacity' => "88"],
            ['location' => "Histology Lab",'capacity' => "50", 'display' => "L",'soundSystem' => "N",'ExamCapacity' => "50"],
            ['location' => "Meseum",'capacity' => "50", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => "0"],
            ['location' => "Pathology Lab",'capacity' => "40", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => ""],
            ['location' => "Biochemistry",'capacity' => "40", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => "20"],
            ['location' => "Pharmacy",'capacity' => "50", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => "0"],
            ['location' => "Physiology Lab",'capacity' => "25", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "0"],
            ['location' => "Others",'capacity' => "0", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => "0"],
            ['location' => "IMDC L-1",'capacity' => "100", 'display' => "P",'soundSystem' => "Y",'ExamCapacity' => "60"],
            ['location' => "IMDC L-2",'capacity' => "100", 'display' => "P",'soundSystem' => "Y",'ExamCapacity' => "60"],
            ['location' => "IMDC L-3",'capacity' => "100", 'display' => "P",'soundSystem' => "Y",'ExamCapacity' => "60"],
            ['location' => "IMDC L-4",'capacity' => "100", 'display' => "P",'soundSystem' => "Y",'ExamCapacity' => "60"],
            ['location' => "IMDC L-5",'capacity' => "150", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "120"],
            // ['location' => "Auditorium ANTH",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            ['location' => "Tutorial Room-1",'capacity' => "50", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "0"],
            ['location' => "Tutorial Room-2",'capacity' => "30", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "0"],
             ['location' => "Tutorial Room-3",'capacity' => "50", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "0"],
             ['location' => "Tutorial Room-5",'capacity' => "80", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "50"],
            ['location' => "Tutorial Room-6",'capacity' => "70", 'display' => "P",'soundSystem' => "Y",'ExamCapacity' => "50"],
            //['location' => "Lecture Hall-9",'capacity' => "80", 'display' => "P",'soundSystem' => "Y",'ExamCapacity' => "0"],
            //['location' => "Lecture Hall-10",'capacity' => "70", 'display' => "P",'soundSystem' => "Y",'ExamCapacity' => "60"],
            ['location' => "Common Room-1",'capacity' => "70", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "60"],
            ['location' => "Common Room-2",'capacity' => "80", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "60"],
            // ['location' => "DPT GYM ANTH Ground Floor",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            ['location' => "INC L-1",'capacity' => "50", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "40"],
            ['location' => "INC L-2",'capacity' => "50", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "40"],
            ['location' => "INC L-3",'capacity' => "70", 'display' => "L",'soundSystem' => "N",'ExamCapacity' => "50"],
            ['location' => "INC L-4",'capacity' => "60", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "50"],
            ['location' => "INC L-5",'capacity' => "36", 'display' => "L",'soundSystem' => "N",'ExamCapacity' => "25"],
            ['location' => "INC L-6",'capacity' => "30", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => "20"],
            // ['location' => "CME EYE",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Lecture Hall-6",'capacity' => "30", 'display' => "No",'soundSystem' => "N",'ExamCapacity' => "0"],
            // ['location' => "General Medicine Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Cardiology Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Pulmonology Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Gastroenterology Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Nephrology Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Dermatology Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "General Surgery Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Urology Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Orthopaedic Surgery Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Neurosurgery Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Plastic Surgery Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Oncology Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Psychology Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Dental Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Paediatric Surgery Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Paediatrics Clinic l",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Paediatrics Clinic ll",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Obstetrics & Gynaecology Clinic l",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Obstetrics & Gynaecology Clinic ll",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
             ['location' => "CME Gynae",'capacity' => "35", 'display' => "L",'soundSystem' => "N",'ExamCapacity' => "0"],
            // ['location' => "Haematology Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Ophthalmology Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Optometry Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Ophthalmic Diagnostic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "ENT Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "ENT CME Room",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            ['location' => "CME Paeds",'capacity' => "25", 'display' => "P",'soundSystem' => "N",'ExamCapacity' => "0"],
            // ['location' => "Breast Clinic",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Eye CME Room (MLT)",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
            // ['location' => "Office",'capacity' => "", 'display' => "",'soundSystem' => "",'ExamCapacity' => "0"],
             ['location' => "Outside Organization",'capacity' => "0", 'display' => "N",'soundSystem' => "N",'ExamCapacity' => "0"],
            // ['location' => "Room # 110"],
            // ['location' => "Room # 111"],
            // ['location' => "Room # 117"],
            ],
        );
        
    }
}
