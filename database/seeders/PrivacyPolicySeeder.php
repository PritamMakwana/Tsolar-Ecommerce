<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivacyPolicy::create([
            'title' => '
            <div class="d-flex justify-content-center align-items-center">
              <h3 class="privacy" style="color: #4DEAFF;font-weight: 500;
                    font-size: 26px;
                    margin-bottom: 10px;">Privacy Policy</h3>
            </div></div>',
            'description' => '<div class="d-flex flex-column text-center">
            <h1 class="" style="font-weight: 600;">We care about your privacy</h1>
            <p style="font-weight: 18px;
            font-weight: 400;"> At Tsolar, we prioritize the protection of your privacy. We are committed to respecting your
              privacy
              regarding any information we may gather from you through our website.</p>
          </div>
          <div class=" d-flex flex-column mt-2">
            <p class="text-start" style="font-weight: 18px;
            font-weight: 400;">
              Mi tincidunt elit, id quisque ligula ac diam, amet. Vel etiam suspendisse morbi eleifend faucibus
              eget vestibulum felis. Dictum quis montes, sit sit. Tellus aliquam enim urna, etiam. Mauris
              posuere vulputate arcu amet, vitae nisi, tellus tincidunt. At feugiat sapien varius id.
      
            </p>
            <br>
            <p style="font-weight: 18px;
            font-weight: 400;">Eget quis mi enim, leo lacinia pharetra, semper. Eget in volutpat mollis at volutpat lectus
              velit, sed auctor. Porttitor fames arcu quis fusce augue enim. Quis at habitant diam at. Suscipit
              tristique risus, at donec. In turpis vel et quam imperdiet. Ipsum molestie aliquet sodales id est
              ac volutpat.
            </p>
      
          </div>
          <div class="d-flex flex-column">
            <h3 style="font-weight: 500;
                  font-size: 26px;
                  margin-bottom: 10px;">How do we keep your information safe?</h3>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Dolor enim eu tortor urna sed duis nulla. Aliquam vestibulum, nulla odio nisl vitae. In aliquet
              pellentesque aenean hac vestibulum turpis mi bibendum diam. Tempor integer aliquam in vitae
              malesuada fringilla.
            </p>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Elit nisi in eleifend sed nisi. Pulvinar at orci, proin imperdiet commodo consectetur convallis
              risus. Sed condimentum enim dignissim adipiscing faucibus consequat, urna. Viverra purus et erat
              auctor aliquam. Risus, volutpat vulputate posuere purus sit congue convallis aliquet. Arcu id
              augue ut feugiat donec porttitor neque. Mauris, neque ultricies eu vestibulum, bibendum quam lorem
              id. Dolor lacus, eget nunc lectus in tellus, pharetra, porttitor.
            </p>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Ipsum sit mattis nulla quam nulla. Gravida id gravida ac enim mauris id. Non pellentesque congue
              eget consectetur turpis. Sapien, dictum molestie sem tempor. Diam elit, orci, tincidunt aenean
              tempus. Quis velit eget ut tortor tellus. Sed vel, congue felis elit erat nam nibh orci.
            </p>
          </div>
          <div class="d-flex flex-column">
            <h3 style="font-weight: 500;
            font-size: 26px;
            margin-bottom: 10px;">What information do we collect?</h3>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Dolor enim eu tortor urna sed duis nulla. Aliquam vestibulum, nulla odio nisl vitae. In aliquet
              pellentesque aenean hac vestibulum turpis mi bibendum diam. Tempor integer aliquam in vitae
              malesuada fringilla.<br>
            </p>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Elit nisi in eleifend sed nisi. Pulvinar at orci, proin imperdiet commodo consectetur convallis
              risus. Sed condimentum enim dignissim adipiscing faucibus consequat, urna. Viverra purus et erat
              auctor aliquam. Risus, volutpat vulputate posuere purus sit congue convallis aliquet. Arcu id
              augue ut feugiat donec porttitor neque. Mauris, neque ultricies eu vestibulum, bibendum quam lorem
              id. Dolor lacus, eget nunc lectus in tellus, pharetra, porttitor.
            </p>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Ipsum sit mattis nulla quam nulla. Gravida id gravida ac enim mauris id. Non pellentesque congue
              eget consectetur turpis. Sapien, dictum molestie sem tempor. Diam elit, orci, tincidunt aenean
              tempus. Quis velit eget ut tortor tellus. Sed vel, congue felis elit erat nam nibh orci.
            </p>
          </div>
          <div class="d-flex flex-column">
            <h3 style="font-weight: 500;
            font-size: 26px;
            margin-bottom: 10px;">How do we use your information?</h3>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Dolor enim eu tortor urna sed duis nulla. Aliquam vestibulum, nulla odio nisl vitae. In aliquet
              pellentesque aenean hac vestibulum turpis mi bibendum diam. Tempor integer aliquam in vitae
              malesuada fringilla.<br>
            </p>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Elit nisi in eleifend sed nisi. Pulvinar at orci, proin imperdiet commodo consectetur convallis
              risus. Sed condimentum enim dignissim adipiscing faucibus consequat, urna. Viverra purus et erat
              auctor aliquam. Risus, volutpat vulputate posuere purus sit congue convallis aliquet. Arcu id
              augue ut feugiat donec porttitor neque. Mauris, neque ultricies eu vestibulum, bibendum quam lorem
              id. Dolor lacus, eget nunc lectus in tellus, pharetra, porttitor.
            </p>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Ipsum sit mattis nulla quam nulla. Gravida id gravida ac enim mauris id. Non pellentesque congue
              eget consectetur turpis. Sapien, dictum molestie sem tempor. Diam elit, orci, tincidunt aenean
              tempus. Quis velit eget ut tortor tellus. Sed vel, congue felis elit erat nam nibh orci.
            </p>
          </div>
          <div class="d-flex flex-column">
            <h3 style="font-weight: 500;
            font-size: 26px;
            margin-bottom: 10px;">What are your privacy rights?</h3>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Pharetra morbi libero id aliquam elit massa integer tellus. Quis felis aliquam ullamcorper porttitor.
              Pulvinar ullamcorper sit dictumst ut eget a, elementum eu. Maecenas est morbi mattis id in ac
              pellentesque ac.
            </p>
          </div>
          <div class="d-flex flex-column">
            <h3 style="font-weight: 500;
            font-size: 26px;
            margin-bottom: 10px;">How can you contact us about this policy?</h3>
            <p style="font-weight: 18px;
            font-weight: 400;">
              Sagittis et eu at elementum, quis in. Proin praesent volutpat egestas sociis sit lorem nunc nunc
              sit. Eget diam curabitur mi ac. Auctor rutrum lacus malesuada massa ornare et. Vulputate
              consectetur ac ultrices at diam dui eget fringilla tincidunt. Arcu sit dignissim massa erat cursus
              vulputate gravida id. Sed quis auctor vulputate hac elementum gravida cursus dis.
            </p>
            <ol>
      
      
              <li>
                Lectus id duis vitae porttitor enim gravida morbi.
              </li>
              <li>
                Eu turpis posuere semper feugiat volutpat elit, ultrices suspendisse. Auctor vel in vitae
                placerat.
              </li>
              <li>
                Suspendisse maecenas ac donec scelerisque diam sed est duis purus.
              </li>
            </ol>',
        ]);
    }
}
