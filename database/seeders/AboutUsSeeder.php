<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'title' => '<div class="d-flex justify-content-center align-items-center">
            <h3 class="privacy" style="color: #4DEAFF;font-weight: 500;
        font-size: 26px;
        margin-bottom: 10px;">About Us</h3>
        </div>',
            'description' => '<div class="d-flex flex-column text-center">
            <h1 style="font-weight: 600;">We are Tsolar</h1>
            <p style="font-weight: 18px;
            font-weight: 400;">At Tsolar, we are dedicated to making the world a greener and more sustainable place.
                Our mission is to provide
                innovative solar solutions that harness the power of the sun to create a cleaner, brighter future for
                all.</p>
        </div>
        <div class="d-flex flex-column mt-2">
            <p style="font-weight: 18px;
            font-weight: 400;" class="text-start">
                We believe that renewable energy is the key to a sustainable future. With a focus on solar energy, we
                aim to
                deliver eco-friendly and cost-effective solutions for your energy needs. Our team of experts is
                committed to
                delivering high-quality solar products and services tailored to your requirements.
            </p>
            <p style="font-weight: 18px;
            font-weight: 400;">
                Whether you\'re an individual looking to make your home more energy-efficient or a business striving to
                reduce
                your carbon footprint, Tsolar is here to assist you on your journey to a cleaner and greener future.
            </p>
        </div>
        <div class="d-flex flex-column">
            <h3 style="font-weight: 500;
        font-size: 26px;
        margin-bottom: 10px;">Why Choose Tsolar?</h3>
            <p style="font-weight: 18px;
            font-weight: 400;">
                At Tsolar, we understand that the decision to switch to solar energy is an important one. That\'s why we
                offer
                cutting-edge solar solutions that are reliable, efficient, and environmentally friendly. When you choose
                us,
                you\'re choosing:
            </p>
            <ol>
                <li>Quality Products: Our solar panels and equipment are of the highest quality, ensuring optimal
                    performance and longevity.
                </li>
                <li>Expertise: Our team of professionals consists of solar experts who are passionate about making a
                    positive environmental impact.
                </li>
                <li>Customized Solutions: We tailor our services to meet your specific energy needs, from residential to
                    commercial projects.
                </li>
                <li>Sustainability: We are committed to a sustainable future and work tirelessly to reduce our
                    collective
                    carbon footprint.
                </li>
            </ol>
        </div>',
        ]);
    }
}
