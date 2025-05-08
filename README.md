# Bored Panda FullStack Developer Task Report
![bored-panda.namuio.com](preview.png)
#### By: Namu Makwembo

## Introduction

As part of the FullStack Developer position interview process at Bored Panda, I was tasked with creating a quiz application similar to BuzzFeed quizzes. The application allows users to select a quiz, answer questions, and view a personality-based outcome based on their selections. This report outlines my approach, the live demo, source code, future tasks, and reflections on the task.

## Live Preview

The completed quiz application is hosted on a subdomain of my website for live preview:

**[bored-panda.namuio.com](https://bored-panda.namuio.com)**

## Source Code

The source code is available in the GitHub repository:

**[GitHub Repository](https://github.com/namumakwembo/bored-panda-quiz)**  

## Tech Stack

- **Laravel**: Backend framework for routing, database management, and API logic.
- **Livewire**: For real-time, reactive frontend components without a separate JavaScript framework.
- **Alpine.js**: For lightweight frontend interactivity (e.g., visual feedback on option selection).
- **Tailwind CSS**: For responsive, modern styling with minimal custom CSS.
- **MySQL**: For storing quizzes, questions, options, and outcomes.

I chose this stack because it enables the development of a dynamic, single-page application (SPA) with fast load times, scalability, and a seamless user experience. Livewire and Alpine.js reduce the need for complex JavaScript, while Laravel provides a robust backend for managing dynamic data. Tailwind CSS ensures a clean, responsive UI suitable for Bored Panda’s high-traffic environment (approximately 160 million monthly visitors).

## Approach

### Database Schema and Relationships
To ensure flexibility and scalability, I designed a dynamic database schema:

- **Tables**:
  - `quizzes`: Stores quiz metadata (title, slug, image, description).
  - `questions`: Stores quiz questions (text, order, linked to a quiz).
  - `options`: Stores answer choices (text, linked to a question and outcome).
  - `outcomes`: Stores possible quiz results (title, description, key, linked to a quiz).

- **Relationships**:
  - A `Quiz` has many `Questions` (`hasMany`).
  - A `Question` belongs to a `Quiz` (`belongsTo`) and has many `Options` (`hasMany`).
  - An `Option` belongs to a `Question` (`belongsTo`) and is linked to an `Outcome` (`belongsTo` via `outcome_id`).
  - An `Outcome` belongs to a `Quiz` (`belongsTo`).

This structure allows administrators to add, modify, or delete quizzes, questions, options, and outcomes via a backend interface, supporting long-term scalability for Bored Panda’s large audience.

### Quiz Functionality
The quiz operates as follows:

1. **Landing Page**:
   - Displays a paginated list of quizzes fetched dynamically from the backend.
   - Users can select a quiz to view its overview page.

2. **Quiz Overview Page**:
   - Shows the quiz title, description, total number of questions, and a "Start Quiz" button.
   - Redirects to the quiz question page upon clicking "Start Quiz."

3. **Question Page**:
   - Presents one question at a time with a set of radio button options (typically four per question).
   - Includes "Prev" and "Next" buttons for navigation, with validation to ensure an option is selected before proceeding.
   - Uses Livewire’s in-memory array (`$answers`) to store selected `outcome_id` values, avoiding unnecessary database writes for better performance.
   - Alpine.js provides visual feedback (e.g., highlighting selected options).
   - On the final question, the "Next" button is replaced with a "Complete" button.

4. **Results Page**:
   - Evaluates the `$answers` array to determine the most frequent `outcome_id`.
   - Redirects to a results page displaying the outcome’s title and description.
   - Includes "Back to Quizzes" and "Take Again" buttons for navigation.

### Key Features and Best Practices
- **Validation**: Users must select an option before proceeding, with clear error messages (e.g., "Please select an option").
- **In-Memory Storage**: Refactored the application to store answers in a Livewire array instead of the database, improving performance and reducing database load.
- **Dynamic Data**: The quiz content is fully dynamic, allowing easy updates via the backend.
- **Responsive UI**: Tailwind CSS ensures a mobile-friendly, visually appealing interface.
- **Dark Theme**: Added a dark theme for improved user experience in low-light environments.
- **Pagination**: Implemented pagination on the landing page to optimize load times under high traffic.
- **Git Best Practices**: Used conventional commit messages (e.g., `feat:`, `fix:`) for clarity and collaboration.
- **Documentation**: Included PHPDoc blocks for methods to enhance code maintainability.
- **Testing**: Added initial tests to verify page rendering and application functionality.

### Commit History Highlights
- `feat:dark theme`: Implemented a dark theme for better accessibility.
- `added:error message incase users tries to go to next question without picking an ansser`: Added validation and user-friendly error messages.
- `refactored options to use save anwers in array and evalutate instead of saving to db`: Optimized performance by using in-memory storage.
- `fixed:next & prev buttons`: Ensured smooth navigation between questions.
- `added:quiz page and show questions page`: Built the core quiz and question interfaces.

## Tasks to Be Undertaken After Proof-of-Concept

The proof-of-concept meets the task requirements, but the following enhancements could further improve the application:

1. **Admin Panel for Quiz Management**:
   - Develop a CRUD interface for administrators to create, update, and delete quizzes, questions, options, and outcomes.
   - **Estimated Time**: 8 hours.
   - **Details**: Use Laravel’s built-in authentication and Livewire for a reactive admin dashboard. Include validation and role-based access control.

2. **User Authentication and Quiz History**:
   - Allow users to log in and save their quiz results for later viewing.
   - **Estimated Time**: 6 hours.
   - **Details**: Implement Laravel authentication, add a `user_quiz_results` table, and create a user dashboard to view past results.

3. **Social Sharing for Results**:
   - Add buttons to share quiz results on social media platforms (e.g., Twitter, Facebook).
   - **Estimated Time**: 4 hours.
   - **Details**: Integrate Laravel Socialite or client-side sharing APIs, with dynamic meta tags for outcome previews.

4. **Advanced Outcome Logic**:
   - Handle tied outcomes (e.g., select a random outcome or prioritize based on weights) and support weighted scoring.
   - **Estimated Time**: 3 hours.
   - **Details**: Modify the outcome evaluation logic in the Livewire component and add a `weight` field to the `outcomes` table.

5. **Performance Optimization**:
   - Implement caching (e.g., Laravel’s query caching) for quiz data and lazy-load images on the landing page.
   - **Estimated Time**: 4 hours.
   - **Details**: Use Redis or file-based caching and optimize frontend assets with Vite.

6. **Unit and Feature Tests**:
   - Expand test coverage for quiz logic, outcome evaluation, and edge cases (e.g., no answers selected).
   - **Estimated Time**: 6 hours.
   - **Details**: Write PHPUnit and Dusk tests for critical paths, including quiz completion and result rendering.

**Total Estimated Time**: 31 hours.

## Reflection

### Challenges
The most significant challenge was ensuring that selected options persisted correctly when navigating between questions. Initially, radio buttons did not reflect the saved selections, which required debugging Livewire’s reactivity and Alpine.js integration. I resolved this by using `x-bind:checked` and ensuring the `selectedOption` property was properly initialized in the Livewire component.

Another challenge was optimizing performance for Bored Panda’s high-traffic environment. I initially used database sessions to store answers but refactored to an in-memory array, which reduced database load and improved response times. This decision required careful handling of the `$answers` array to maintain state across navigation.

### Successes
I’m proud of the scalable database schema, which allows dynamic quiz creation and supports Bored Panda’s content-heavy model. The UI, built with Tailwind CSS and enhanced with a dark theme, provides a polished and accessible user experience. The use of Livewire and Alpine.js enabled a reactive, SPA-like interface without the complexity of a separate JavaScript framework, aligning with modern development practices.

### Lessons Learned
This task reinforced the importance of iterative debugging and clear commit messages for collaboration. I learned to balance feature development with performance considerations, especially for high-traffic applications. Working with Livewire’s reactivity taught me to carefully manage state and DOM updates, particularly when integrating with Alpine.js.

### Experience
Completing this task was both challenging and rewarding. It allowed me to showcase my full-stack skills, from database design to frontend interactivity, while addressing real-world constraints like scalability and user experience. I enjoyed the creative freedom to design a BuzzFeed-style quiz and appreciated the opportunity to optimize for a large audience. This experience has prepared me to contribute effectively to Bored Panda’s development team, and I’m excited about the potential to extend this project with features like an admin panel or social sharing.

---

Thank you for the opportunity to complete this task. Please let me know if any clarifications or additional features are needed!