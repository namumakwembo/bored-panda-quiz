<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Outcome;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
      /**
     * Run the database seeds.
     */
    public function run()
    {
        $quizzes = $this->getQuizData();
        foreach ($quizzes as $quizData) {
            $this->createQuiz($quizData);
        }
    }

    /**
     * Get data for all quizzes.
     */
    private function getQuizData(): array
    {
        return [
            // Quiz 1: What Kind of Friend Are You?
            [
                'quiz' => [
                    'title' => 'What Kind of Friend Are You?',
                    'slug' => 'what-kind-of-friend-are-you',
                    'image' => 'https://images.unsplash.com/photo-1539635278303-d4002c07eae3?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'description' => 'Discover your friendship style based on your daily habits!',
                ],
                'outcomes' => [
                    'loyal' => [
                        'title' => 'The Loyal Buddy',
                        'description' => 'You’re the ride-or-die friend who’s always there, no matter what.',
                    ],
                    'fun' => [
                        'title' => 'The Party Starter',
                        'description' => 'You bring the energy and make every hangout unforgettable.',
                    ],
                    'wise' => [
                        'title' => 'The Wise Mentor',
                        'description' => 'You’re the go-to for advice and deep conversations.',
                    ],
                    'chill' => [
                        'title' => 'The Chill Companion',
                        'description' => 'You’re easygoing and make everyone feel at ease.',
                    ],
                ],
                'questions' => [
                    [
                        'text' => 'What’s your group chat vibe?',
                        'order' => 1,
                        'options' => [
                            ['text' => 'Sending heartfelt messages', 'outcome' => 'loyal'],
                            ['text' => 'Spamming memes', 'outcome' => 'fun'],
                            ['text' => 'Dropping life advice', 'outcome' => 'wise'],
                            ['text' => 'Lurking, replying occasionally', 'outcome' => 'chill'],
                        ],
                    ],
                    [
                        'text' => 'How do you cheer up a friend?',
                        'order' => 2,
                        'options' => [
                            ['text' => 'Listen and support', 'outcome' => 'loyal'],
                            ['text' => 'Plan a fun night out', 'outcome' => 'fun'],
                            ['text' => 'Offer thoughtful advice', 'outcome' => 'wise'],
                            ['text' => 'Just hang out quietly', 'outcome' => 'chill'],
                        ],
                    ],
                    [
                        'text' => 'What’s your ideal friend hangout?',
                        'order' => 3,
                        'options' => [
                            ['text' => 'Heart-to-heart at a café', 'outcome' => 'loyal'],
                            ['text' => 'Karaoke or dancing', 'outcome' => 'fun'],
                            ['text' => 'Debating big ideas', 'outcome' => 'wise'],
                            ['text' => 'Netflix and snacks', 'outcome' => 'chill'],
                        ],
                    ],
                ],
            ],
            // Quiz 2: Which Movie Genre Is Your Life?
            [
                'quiz' => [
                    'title' => 'Which Movie Genre Is Your Life?',
                    'slug' => 'which-movie-genre-is-your-life',
                    'image' => 'https://images.unsplash.com/photo-1595769816263-9b910be24d5f?q=80&w=2958&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'description' => 'Find out if your life is a rom-com, thriller, or something else!',
                ],
                'outcomes' => [
                    'romcom' => [
                        'title' => 'Romantic Comedy',
                        'description' => 'Your life is full of love, laughs, and happy endings.',
                    ],
                    'thriller' => [
                        'title' => 'Thriller',
                        'description' => 'You thrive on suspense and unexpected twists.',
                    ],
                    'drama' => [
                        'title' => 'Drama',
                        'description' => 'Your life is an emotional rollercoaster with deep moments.',
                    ],
                    'adventure' => [
                        'title' => 'Adventure',
                        'description' => 'You’re always chasing the next big journey.',
                    ],
                ],
                'questions' => [
                    [
                        'text' => 'What’s your weekend vibe?',
                        'order' => 1,
                        'options' => [
                            ['text' => 'Date night or friends', 'outcome' => 'romcom'],
                            ['text' => 'Solving a mystery game', 'outcome' => 'thriller'],
                            ['text' => 'Reflecting on life', 'outcome' => 'drama'],
                            ['text' => 'Exploring new places', 'outcome' => 'adventure'],
                        ],
                    ],
                    [
                        'text' => 'How do you handle conflict?',
                        'order' => 2,
                        'options' => [
                            ['text' => 'Talk it out with charm', 'outcome' => 'romcom'],
                            ['text' => 'Strategize and stay sharp', 'outcome' => 'thriller'],
                            ['text' => 'Feel all the emotions', 'outcome' => 'drama'],
                            ['text' => 'Move on to new horizons', 'outcome' => 'adventure'],
                        ],
                    ],
                    [
                        'text' => 'What’s your dream vacation?',
                        'order' => 3,
                        'options' => [
                            ['text' => 'Romantic Paris getaway', 'outcome' => 'romcom'],
                            ['text' => 'Haunted castle tour', 'outcome' => 'thriller'],
                            ['text' => 'Quiet cabin retreat', 'outcome' => 'drama'],
                            ['text' => 'Jungle expedition', 'outcome' => 'adventure'],
                        ],
                    ],
                ],
            ],
            // Quiz 3: What’s Your Dream Career Vibe?
            [
                'quiz' => [
                    'title' => 'What’s Your Dream Career Vibe?',
                    'slug' => 'whats-your-dream-career-vibe',
                    'image' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'description' => 'Discover the work environment that suits your personality best!',
                ],
                'outcomes' => [
                    'corporate' => [
                        'title' => 'Corporate Climber',
                        'description' => 'You thrive in structure and aim for the corner office.',
                    ],
                    'creative' => [
                        'title' => 'Creative Visionary',
                        'Parameter: description' => 'You shine when expressing ideas through art or innovation.',
                    ],
                    'freelance' => [
                        'title' => 'Freelance Free Spirit',
                        'description' => 'You love freedom and working on your own terms.',
                    ],
                    'social' => [
                        'title' => 'Social Impact Star',
                        'description' => 'You’re driven to make a difference in the world.',
                    ],
                ],
                'questions' => [
                    [
                        'text' => 'What’s your work playlist like?',
                        'order' => 1,
                        'options' => [
                            ['text' => 'Instrumental focus tunes', 'outcome' => 'corporate'],
                            ['text' => 'Indie or experimental', 'outcome' => 'creative'],
                            ['text' => 'Whatever I’m feeling', 'outcome' => 'freelance'],
                            ['text' => 'Uplifting anthems', 'outcome' => 'social'],
                        ],
                    ],
                    [
                        'text' => 'What motivates you at work?',
                        'order' => 2,
                        'options' => [
                            ['text' => 'Climbing the ladder', 'outcome' => 'corporate'],
                            ['text' => 'Creating something new', 'outcome' => 'creative'],
                            ['text' => 'Flexible schedule', 'outcome' => 'freelance'],
                            ['text' => 'Helping others', 'outcome' => 'social'],
                        ],
                    ],
                    [
                        'text' => 'What’s your dream office setup?',
                        'order' => 3,
                        'options' => [
                            ['text' => 'Sleek high-rise suite', 'outcome' => 'corporate'],
                            ['text' => 'Colorful studio space', 'outcome' => 'creative'],
                            ['text' => 'Cozy home office', 'outcome' => 'freelance'],
                            ['text' => 'Community hub', 'outcome' => 'social'],
                        ],
                    ],
                ],
            ],
            // Quiz 4: Which Season Matches Your Soul?
            [
                'quiz' => [
                    'title' => 'Which Season Matches Your Soul?',
                    'slug' => 'which-season-matches-your-soul',
                    'image' => 'https://images.unsplash.com/photo-1593362831502-5c3ad1c05f57?q=80&w=2912&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'description' => 'Find out if you’re a sunny summer or a cozy winter!',
                ],
                'outcomes' => [
                    'spring' => [
                        'title' => 'Spring',
                        'description' => 'You’re fresh, hopeful, and always ready for new beginnings.',
                    ],
                    'summer' => [
                        'title' => 'Summer',
                        'description' => 'You’re vibrant, warm, and love living life to the fullest.',
                    ],
                    'fall' => [
                        'title' => 'Fall',
                        'description' => 'You’re introspective, cozy, and embrace change gracefully.',
                    ],
                    'winter' => [
                        'title' => 'Winter',
                        'description' => 'You’re calm, reflective, and shine in quiet moments.',
                    ],
                ],
                'questions' => [
                    [
                        'text' => 'What’s your go-to weekend activity?',
                        'order' => 1,
                        'options' => [
                            ['text' => 'Gardening or hiking', 'outcome' => 'spring'],
                            ['text' => 'Beach or BBQ', 'outcome' => 'summer'],
                            ['text' => 'Reading by a fire', 'outcome' => 'fall'],
                            ['text' => 'Snowy walks', 'outcome' => 'winter'],
                        ],
                    ],
                    [
                        'text' => 'Pick a drink to sip on.',
                        'order' => 2,
                        'options' => [
                            ['text' => 'Floral tea', 'outcome' => 'spring'],
                            ['text' => 'Iced lemonade', 'outcome' => 'summer'],
                            ['text' => 'Pumpkin spice latte', 'outcome' => 'fall'],
                            ['text' => 'Hot cocoa', 'outcome' => 'winter'],
                        ],
                    ],
                    [
                        'text' => 'What’s your favorite type of weather?',
                        'order' => 3,
                        'options' => [
                            ['text' => 'Mild and breezy', 'outcome' => 'spring'],
                            ['text' => 'Hot and sunny', 'outcome' => 'summer'],
                            ['text' => 'Crisp and colorful', 'outcome' => 'fall'],
                            ['text' => 'Cold and snowy', 'outcome' => 'winter'],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Create a quiz and its related outcomes, questions, and options.
     */
    private function createQuiz(array $data): void
    {
        // Create the quiz
        $quiz = Quiz::create([
            'title' => $data['quiz']['title'],
            'slug' => $data['quiz']['slug'],
            'image' => $data['quiz']['image'],
            'description' => $data['quiz']['description'],
        ]);

        // Create outcomes
        $this->createOutcomes($quiz->id, $data['outcomes']);

        // Create questions and options
        $this->createQuestionsAndOptions($quiz->id, $data['questions']);
    }

    /**
     * Create outcomes for a quiz.
     */
    private function createOutcomes(int $quizId, array $outcomes): void
    {
        foreach ($outcomes as $key => $outcome) {
            Outcome::create([
                'quiz_id' => $quizId,
                'key' => $key,
                'title' => $outcome['title']
            ]);
        }
    }

    /**
     * Create questions and their associated options.
     */
    private function createQuestionsAndOptions(int $quizId, array $questions): void
    {
        foreach ($questions as $questionData) {
            // Create question
            $question = Question::create([
                'quiz_id' => $quizId,
                'text' => $questionData['text'],
                'order' => $questionData['order'],
            ]);

            // Create options
            foreach ($questionData['options'] as $option) {
                $outcome = Outcome::where('quiz_id', $quizId)
                    ->where('key', $option['outcome'])
                    ->first();

                Option::create([
                    'quiz_id' => $quizId,
                    'question_id' => $question->id,
                    'outcome_id' => $outcome->id,
                    'text' => $option['text'],
                ]);
            }
        }
    }
}
