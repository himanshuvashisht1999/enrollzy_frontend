<?php

namespace App\Support\Career;

/**
 * Fixed texts of the career roadmap page (client design "Career roadmap redesign"): headings, stream cards, stream
 * quiz, FAQs and blog / question topics. The classes, groups and roadmaps themselves come from the Career Roadmap
 * module (CareerData).
 */
class CareerContent
{
    public static function defaults(): array
    {
        return [
            'meta_title' => 'Career roadmap: from Class 5 to your first job | Enrollzy',
            'meta_description' => 'Free career roadmaps: the stream, exam, counselling, course and years each step takes, for doctor, engineer, CA, lawyer, civil servant and more. Download any roadmap as a PDF.',
            'kicker_badge' => 'Free',
            'kicker' => 'Career roadmaps from Class 5 to your first job',
            'title' => 'Know your next step.',
            'title_em' => 'See the whole path.',
            'lede' => 'Tell us where you are and what interests you. We show every step to the career: the stream, the exam, the counselling, the course and the years each takes, with links to the right pages on Enrollzy.',
            'search_placeholder' => 'Search: JEE, NEET, Doctor, CA, Law…',
            'trust' => ['Counselling is free', 'DPIIT-recognised platform', 'Real counsellors on call'],
            'how' => ['Where you are', 'What interests you', 'Your roadmap'],

            'lead_badge' => 'Free · takes 30 seconds',
            'lead_title' => 'Get your personal roadmap from a career expert',
            'lead_text' => 'Tell us your class. A counsellor calls you with two or three paths that fit your marks and budget.',

            'build_title' => 'Build your roadmap',
            'build_sub' => 'Three choices. The roadmap updates as you pick.',
            'roadmap_cta_title' => 'Get this roadmap on WhatsApp',
            'roadmap_cta_text' => 'Plus a free call to check it against your marks and budget.',

            'explore_title' => 'Explore roadmaps',
            'explore_sub' => 'Every class and every path: the exams, scholarships, streams and careers open to you, step by step.',
            'pdf_title' => 'Download any roadmap as a PDF, free',
            'pdf_text' => 'Every option with its eligibility and fee on one page. Keep it, print it or share it with your parents.',

            'streams_title' => 'After Class 10: which stream?',
            'streams_sub' => 'What each choice opens, what it closes, and the exams that follow.',
            'streams' => [
                ['name' => 'Science (PCM)', 'subjects' => 'Physics, Chemistry, Maths',
                    'opens' => ['Engineering', 'Architecture', 'Data science', 'Defence (Air Force, Navy)', 'Aviation', 'Statistics'],
                    'closes' => ['Medicine through NEET (needs Biology)'],
                    'exams' => ['JEE Main', 'JEE Advanced', 'State CETs', 'NATA', 'NDA', 'CUET UG']],
                ['name' => 'Science (PCB)', 'subjects' => 'Physics, Chemistry, Biology',
                    'opens' => ['Medicine', 'Dentistry', 'Nursing', 'Pharmacy', 'Biotech', 'Agriculture', 'Psychology'],
                    'closes' => ['Core engineering through JEE (needs Maths)'],
                    'exams' => ['NEET UG', 'ICAR through CUET', 'State CETs', 'CUET UG']],
                ['name' => 'Commerce', 'subjects' => 'Accountancy, Business Studies, Economics',
                    'opens' => ['CA', 'CS', 'CMA', 'B.Com', 'BBA', 'Economics', 'Banking', 'Management'],
                    'closes' => ['Engineering and medicine'],
                    'exams' => ['CA Foundation', 'CUET UG', 'IPMAT', 'CLAT']],
                ['name' => 'Arts / Humanities', 'subjects' => 'History, Political Science, Psychology and others',
                    'opens' => ['Law', 'Civil services', 'Journalism', 'Psychology', 'Design', 'Teaching', 'Social sciences'],
                    'closes' => ['Engineering and medicine'],
                    'exams' => ['CUET UG', 'CLAT', 'NID DAT', 'NIFT', 'UCEED']],
                ['name' => 'Diploma / ITI', 'subjects' => 'Trade or polytechnic course',
                    'opens' => ['Technician jobs', 'Apprenticeships', 'Lateral entry to B.Tech 2nd year (diploma)'],
                    'closes' => ['Direct NEET or JEE route'],
                    'exams' => ['State polytechnic entrance', 'Lateral entry exams']],
            ],
            'quiz_title' => 'Still confused between streams?',
            'quiz_text' => 'Answer 4 quick questions and see which stream fits you.',
            'quiz_button' => 'Take the 2-minute stream quiz',
            'quiz' => [
                ['question' => 'Which subject do you enjoy the most?', 'options' => [
                    ['text' => 'Maths and puzzles', 'stream' => 'Science (PCM)'], ['text' => 'Biology and how the body works', 'stream' => 'Science (PCB)'],
                    ['text' => 'Business, money and numbers', 'stream' => 'Commerce'], ['text' => 'Languages, history or people', 'stream' => 'Arts / Humanities']]],
                ['question' => 'What would you rather do on a free afternoon?', 'options' => [
                    ['text' => 'Build or fix something', 'stream' => 'Science (PCM)'], ['text' => 'Read about health or nature', 'stream' => 'Science (PCB)'],
                    ['text' => 'Plan a small business idea', 'stream' => 'Commerce'], ['text' => 'Write, draw or debate', 'stream' => 'Arts / Humanities']]],
                ['question' => 'Which job sounds closest to you?', 'options' => [
                    ['text' => 'Engineer or data scientist', 'stream' => 'Science (PCM)'], ['text' => 'Doctor or pharmacist', 'stream' => 'Science (PCB)'],
                    ['text' => 'CA or manager', 'stream' => 'Commerce'], ['text' => 'Lawyer, designer or civil servant', 'stream' => 'Arts / Humanities']]],
                ['question' => 'How do you feel about long entrance exam preparation?', 'options' => [
                    ['text' => 'Ready for JEE-level maths', 'stream' => 'Science (PCM)'], ['text' => 'Ready for NEET-level biology', 'stream' => 'Science (PCB)'],
                    ['text' => 'Prefer professional exams like CA', 'stream' => 'Commerce'], ['text' => 'Prefer CUET, CLAT or a portfolio', 'stream' => 'Arts / Humanities']]],
            ],

            'help_tag' => 'Free career counselling',
            'help_title' => 'Still not sure?|Talk to a counsellor, free.',
            'help_text' => 'A short call about your interests, marks and budget. You leave with two or three paths that fit, and the next step for each.',
            'help_steps' => ['Share your stage and interests', 'Get two or three paths with exams and colleges', 'Know your next step and the dates to watch'],
            'help_form_title' => 'Book a free career call',

            'faq_title' => 'Career roadmap FAQs',
            'faqs' => [
                ['q' => 'When should I start planning my career?', 'a' => 'Class 9 or 10 is the best time to start, because the stream you pick after Class 10 decides which entrance exams you can take. Earlier classes are for exploring interests.'],
                ['q' => 'Can I become a doctor if I took PCM?', 'a' => 'Not through NEET UG unless you add Biology. NEET needs Physics, Chemistry and Biology in Class 12. Some boards let you take Biology as an additional subject.'],
                ['q' => 'Is commerce only for CA?', 'a' => 'No. Commerce also leads to B.Com, BBA, economics, banking, company secretary and management. CA, CS and CMA are the professional routes.'],
                ['q' => 'How accurate are these durations?', 'a' => 'They are typical durations for full-time study in India. Your actual time can be longer if you take a drop year, repeat an exam or study part-time.'],
            ],

            'learn_title' => 'Read, ask and discuss',
            'learn_sub' => 'Guides from our counsellors and questions from students like you on Ask Enrollzy.',
            'topics' => [
                ['label' => 'Stream selection', 'keywords' => ['stream', 'class 10', 'class 11', 'PCM', 'PCB', 'humanities', 'after 10th']],
                ['label' => 'NEET and medicine', 'keywords' => ['NEET', 'MBBS', 'medical', 'medicine', 'doctor', 'nursing', 'pharmacy']],
                ['label' => 'JEE and engineering', 'keywords' => ['JEE', 'engineering', 'B.Tech', 'BTech', 'IIT', 'NIT']],
                ['label' => 'CA and commerce', 'keywords' => ['CA', 'chartered', 'commerce', 'B.Com', 'BCom', 'BBA', 'CMA']],
                ['label' => 'MBA and management', 'keywords' => ['MBA', 'CAT', 'management', 'PGDM']],
                ['label' => 'AI, data and tech', 'keywords' => ['AI', 'artificial intelligence', 'data', 'BCA', 'python', 'coding']],
                ['label' => 'Law', 'keywords' => ['law', 'CLAT', 'LLB', 'lawyer']],
                ['label' => 'Government jobs', 'keywords' => ['UPSC', 'IAS', 'civil services', 'government job', 'SSC', 'NDA']],
                ['label' => 'Design', 'keywords' => ['design', 'NID', 'NIFT', 'UCEED']],
            ],
            'ask_label' => 'Ask the community or a counsellor',
            'ask_placeholder' => 'e.g. Can I do BCA after Commerce without Maths?',
            'ask_note' => 'Counsellors usually answer here, and you can get a call if you want one.',

            'whatsapp' => '',
        ];
    }

    public static function load(): array
    {
        return self::defaults();
    }
}
