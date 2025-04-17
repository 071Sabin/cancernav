<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// 'rememberToken' => Str::random(10),
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('admin')->insert([

            'name' => 'admin1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // DB::table('navigator')->insert([
        //     'navigatorId' => 'nav-002',
        //     'hospitalId' => 'NY21',
        //     'name' => 'navigator1',
        //     'email' => 'navigator@gmail.com',
        //     'password' => bcrypt('navigator123'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('navigator')->insert([
        //     'navigatorId' => 'nav-001',
        //     'name' => 'navigator2',
        //     'email' => 'navigator2@gmail.com',
        //     'password' => bcrypt('navigator123'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('patient')->insert([
        //     'hospitalId' => 'NY21',
        //     'navigatorId' => 'nav-001',
        //     'patientId' => 'p-001',
        //     'name' => 'Alice Johnson',
        //     'dateofbirth' => '1975-08-15',
        //     'email' => 'alice.johnson@example.com',
        //     'phone' => '212-555-1234',
        //     'address' => '123 Main St',
        //     'city' => 'New York',
        //     'state' => 'NY',
        //     'zipcode' => '10001',
        //     'diagnosis' => 'Breast Cancer',
        //     'treatment_plan' => 'Chemotherapy, Surgery',
        //     'insuranceProvider' => 'Blue Cross Blue Shield',
        //     'insurance_policy_number' => 'BCBS12345',
        //     'financial_status' => 'Moderate',
        //     'yearly_income' => '60000',
        //     'emergency_contact' => 'Bob Johnson, 917-555-5678',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password123'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('patient')->insert([
        //     'hospitalId' => 'NY21',
        //     'navigatorId' => 'nav-002',
        //     'patientId' => 'p-002',
        //     'name' => 'Carlos Rodriguez',
        //     'dateofbirth' => '1982-03-22',
        //     'email' => 'carlos.rodriguez@example.com',
        //     'phone' => '646-555-9876',
        //     'address' => '456 Elm Ave',
        //     'city' => 'New York',
        //     'state' => 'NY',
        //     'zipcode' => '10002',
        //     'diagnosis' => 'Lung Cancer',
        //     'treatment_plan' => 'Radiation Therapy',
        //     'insuranceProvider' => 'Aetna',
        //     'insurance_policy_number' => 'AETNA67890',
        //     'financial_status' => 'Low',
        //     'yearly_income' => '35000',
        //     'emergency_contact' => 'Maria Rodriguez, 347-555-4321',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password456'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('patient')->insert([
        //     'hospitalId' => 'NY21',
        //     'navigatorId' => 'nav-001',
        //     'patientId' => 'p-003',
        //     'name' => 'David Lee',
        //     'dateofbirth' => '1968-11-01',
        //     'email' => 'david.lee@example.com',
        //     'phone' => '917-555-2345',
        //     'address' => '789 Oak St',
        //     'city' => 'New York',
        //     'state' => 'NY',
        //     'zipcode' => '10003',
        //     'diagnosis' => 'Prostate Cancer',
        //     'treatment_plan' => 'Hormone Therapy',
        //     'insuranceProvider' => 'UnitedHealthcare',
        //     'insurance_policy_number' => 'UHC13579',
        //     'financial_status' => 'High',
        //     'yearly_income' => '120000',
        //     'emergency_contact' => 'Susan Lee, 212-555-8765',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password789'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('patient')->insert([
        //     'hospitalId' => 'NY21',
        //     'navigatorId' => 'nav-002',
        //     'patientId' => 'p-004',
        //     'name' => 'Emily Chen',
        //     'dateofbirth' => '1990-06-30',
        //     'email' => 'emily.chen@example.com',
        //     'phone' => '347-555-6789',
        //     'address' => '101 Pine Ln',
        //     'city' => 'New York',
        //     'state' => 'NY',
        //     'zipcode' => '10004',
        //     'diagnosis' => 'Leukemia',
        //     'treatment_plan' => 'Stem Cell Transplant',
        //     'insuranceProvider' => 'Cigna',
        //     'insurance_policy_number' => 'CIGNA24680',
        //     'financial_status' => 'Moderate',
        //     'yearly_income' => '75000',
        //     'emergency_contact' => 'Kevin Chen, 646-555-3456',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password101'),

        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('patient')->insert([
        //     'hospitalId' => 'NY21',
        //     'navigatorId' => 'nav-001',
        //     'patientId' => 'p-005',
        //     'name' => 'Frank Garcia',
        //     'dateofbirth' => '1979-09-18',
        //     'email' => 'frank.garcia@example.com',
        //     'phone' => '212-555-7890',
        //     'address' => '121 Willow Rd',
        //     'city' => 'New York',
        //     'state' => 'NY',
        //     'zipcode' => '10005',
        //     'diagnosis' => 'Colon Cancer',
        //     'treatment_plan' => 'Surgery, Chemotherapy',
        //     'insuranceProvider' => 'MetroPlus',
        //     'insurance_policy_number' => 'MPLUS98765',
        //     'financial_status' => 'Low',
        //     'yearly_income' => '40000',
        //     'emergency_contact' => 'Laura Garcia, 917-555-1212',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password121'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}