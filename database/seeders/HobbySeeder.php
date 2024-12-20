<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $jsonData = '[
    {
      "name":"Agile methods"
    },
    {
      "name":"Activism"
    },
    {
      "name":"Authenticity"
    },
    {
      "name":"GNI"
    },
    {
      "name":"Blockchain"
    },
    {
      "name":"Blogging"
    },
    {
      "name":"Coaching"
    },
    {
      "name":"Corporate Social Responsibility"
    },
    {
      "name":"Creative thinking"
    },
    {
      "name":"Democracy"
    },
    {
      "name":"Digital Media"
    },
    {
      "name":"Digital Marketing"
    },
    {
      "name":"Digitization"
    },
    {
      "name":"Diversity"
    },
    {
      "name":"Eco-Design"
    },
    {
      "name":"Emancipation"
    },
    {
      "name":"Energy efficiency"
    },
    {
      "name":"Engagement"
    },
    {
      "name":"Development"
    },
    {
      "name":"Nutrition"
    },
    {
      "name":"Europe"
    },
    {
      "name":"Fair Finance"
    },
    {
      "name":"Family"
    },
    {
      "name":"Finance"
    },
    {
      "name":"Refugee Solidarity"
    },
    {
      "name":"Freedom"
    },
    {
      "name":"Peace"
    },
    {
      "name":"Gastronomy"
    },
    {
      "name":"Money system"
    },
    {
      "name":"Community"
    },
    {
      "name":"Genetic engineering"
    },
    {
      "name":"Justice"
    },
    {
      "name":"Social commitment"
    },
    {
      "name":"Graphic Design"
    },
    {
      "name":"Basic Income"
    },
    {
      "name":"Green Living"
    },
    {
      "name":"Impact"
    },
    {
      "name":"Improvisation"
    },
    {
      "name":"Integration"
    },
    {
      "name":"Intercultural communication"
    },
    {
      "name":"Journalism"
    },
    {
      "name":"Youth"
    },
    {
      "name":"Children"
    },
    {
      "name":"Climate protection"
    },
    {
      "name":"Cooking"
    },
    {
      "name":"Cooperation"
    },
    {
      "name":"Creativity"
    },
    {
      "name":"Food"
    },
    {
      "name":"Lifestyle"
    },
    {
      "name":"Love"
    },
    {
      "name":"Local food"
    },
    {
      "name":"Marketing"
    },
    {
      "name":"Music"
    },
    {
      "name":"Muslim Community"
    },
    {
      "name":"Online Marketing"
    },
    {
      "name":"Organizational Development"
    },
    {
      "name":"Politics"
    },
    {
      "name":"Project Management"
    },
    {
      "name":"Facilitation"
    },
    {
      "name":"Regional"
    },
    {
      "name":"Regional Agriculture"
    },
    {
      "name":"Regional Development"
    },
    {
      "name":"Self-determination"
    },
    {
      "name":"Self-reflection"
    },
    {
      "name":"Social Media"
    },
    {
      "name":"Social Media Marketing"
    },
    {
      "name":"Software"
    },
    {
      "name":"Social Innovations"
    },
    {
      "name":"Social Innovations in the Global South"
    },
    {
      "name":"Social value added"
    },
    {
      "name":"Social Theater"
    },
    {
      "name":"Sufficiency"
    },
    {
      "name":"Unconscious bias"
    },
    {
      "name":"Event Management"
    },
    {
      "name":"Connectedness promotion"
    },
    {
      "name":"Association Foundation"
    },
    {
      "name":"Virtual Teams"
    },
    {
      "name":"World Food"
    },
    {
      "name":"World Peace"
    },
    {
      "name":"Economy of the Future"
    },
    {
      "name":"Zeitgeist"
    },
    {
      "name":"Sustainable Society"
    },
    {
      "name":"Change management"
    }
  ]';

        $interests = json_decode($jsonData, true);

        Hobby::query()->insert($interests);
    }
}
