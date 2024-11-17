<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Resume</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            padding: 2rem;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background: #1a365d;
            color: white;
            padding: 2rem;
            position: relative;
        }

        .profile-section {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .profile-img-container {
            position: relative;
            width: 150px;
            height: 150px;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid white;
            object-fit: cover;
        }

        .upload-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background: white;
            padding: 8px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        #imageInput {
            display: none;
        }

        .info-section {
            flex-grow: 1;
        }

        .section {
            padding: 2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 1.5rem;
            color: #1a365d;
            font-weight: 600;
        }

        .edit-btn {
            padding: 0.5rem 1rem;
            background: transparent;
            border: 2px solid #1a365d;
            color: #1a365d;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }

        .edit-btn:hover {
            background: #1a365d;
            color: white;
        }

        .education-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .education-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            flex: 1;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #4a5568;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            font-size: 1rem;
        }

        .edit-mode {
            display: none;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 4px;
            margin-top: 1rem;
        }

        .edit-mode.active {
            display: block;
        }

        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .skill-tag {
            background: #e5e7eb;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .save-btn {
            background: #1a365d;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            margin-right: 1rem;
        }

        .cancel-btn {
            background: #dc2626;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .profile-section {
                flex-direction: column;
                text-align: center;
            }

            .form-row {
                flex-direction: column;
            }

            body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="profile-section">
                <div class="profile-img-container">
                    <img src="/api/placeholder/150/150" alt="Profile" id="profileImg" class="profile-img">
                    <label for="imageInput" class="upload-icon">📷</label>
                    <input type="file" id="imageInput" accept="image/*">
                </div>
                <div class="info-section">
                    <h1 id="nameDisplay">John Doe</h1>
                    <p id="ageDisplay">Age: 25</p>
                    <p id="bdayDisplay">Birthday: January 1, 1998</p>
                    <p id="addressDisplay">Address: 123 Main St, City</p>
                    <p id="contactDisplay">Contact: (555) 123-4567</p>
                </div>
                <button class="edit-btn"  style="background: white;" onclick="toggleEdit('personal')">Edit</button>
            </div>
        </div>

        <div class="section" id="personal-edit" style="display: none;">
            <div class="form-row">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" id="nameInput" value="John Doe">
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" id="ageInput" value="25">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Birthday</label>
                    <input type="date" id="bdayInput">
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <input type="tel" id="contactInput" value="(555) 123-4567">
                </div>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" id="addressInput" value="123 Main St, City">
            </div>
            <div class="form-row">
                <button class="save-btn" onclick="savePersonal()">Save</button>
                <button class="cancel-btn" onclick="toggleEdit('personal')">Cancel</button>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Objectives</h2>
                <button class="edit-btn" onclick="toggleEdit('objectives')">Edit</button>
            </div>
            <p id="objectivesDisplay">To secure a challenging position that will enable me to use my strong organizational skills, educational background, and ability to work well with people.</p>
            <div class="edit-mode" id="objectives-edit">
                <div class="form-group">
                    <label>Career Objectives</label>
                    <textarea id="objectivesInput" rows="4"></textarea>
                </div>
                <button class="save-btn" onclick="saveSection('objectives')">Save</button>
                <button class="cancel-btn" onclick="toggleEdit('objectives')">Cancel</button>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Education</h2>
                <button class="edit-btn" onclick="toggleEdit('education')">Edit</button>
            </div>
            <div id="educationDisplay">
                <div class="education-item">
                    <h3>College</h3>
                    <p>BS Computer Science</p>
                    <p>University of Technology</p>
                    <p>2018-2022</p>
                </div>
                <div class="education-item">
                    <h3>Senior High School</h3>
                    <p>Science, Technology, Engineering, and Mathematics</p>
                    <p>City Senior High</p>
                    <p>2016-2018</p>
                </div>
                <div class="education-item">
                    <h3>High School</h3>
                    <p>City High School</p>
                    <p>2012-2016</p>
                </div>
                <div class="education-item">
                    <h3>Elementary</h3>
                    <p>City Elementary School</p>
                    <p>2006-2012</p>
                </div>
            </div>
            <div class="edit-mode" id="education-edit">
                <div class="education-form">
                    <h3>College</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Degree</label>
                            <input type="text" id="collegeDegree">
                        </div>
                        <div class="form-group">
                            <label>School</label>
                            <input type="text" id="collegeSchool">
                        </div>
                        <div class="form-group">
                            <label>Years</label>
                            <input type="text" id="collegeYears">
                        </div>
                    </div>
                </div>
                <div class="education-form">
                    <h3>Senior High School</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Track</label>
                            <input type="text" id="shsTrack">
                        </div>
                        <div class="form-group">
                            <label>School</label>
                            <input type="text" id="shsSchool">
                        </div>
                        <div class="form-group">
                            <label>Years</label>
                            <input type="text" id="shsYears">
                        </div>
                    </div>
                </div>
                <div class="education-form">
                    <h3>High School</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>School</label>
                            <input type="text" id="hsSchool">
                        </div>
                        <div class="form-group">
                            <label>Years</label>
                            <input type="text" id="hsYears">
                        </div>
                    </div>
                </div>
                <div class="education-form">
                    <h3>Elementary</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>School</label>
                            <input type="text" id="elemSchool">
                        </div>
                        <div class="form-group">
                            <label>Years</label>
                            <input type="text" id="elemYears">
                        </div>
                    </div>
                </div>
                <button class="save-btn" onclick="saveSection('education')">Save</button>
                <button class="cancel-btn" onclick="toggleEdit('education')">Cancel</button>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Skills</h2>
                <button class="edit-btn" onclick="toggleEdit('skills')">Edit</button>
            </div>
            <div class="skill-tags" id="skillsDisplay">
                <span class="skill-tag">HTML</span>
                <span class="skill-tag">CSS</span>
                <span class="skill-tag">JavaScript</span>
                <span class="skill-tag">Python</span>
            </div>
            <div class="edit-mode" id="skills-edit">
                <div class="form-group">
                    <label>Skills (comma-separated)</label>
                    <input type="text" id="skillsInput" placeholder="HTML, CSS, JavaScript, Python">
                </div>
                <button class="save-btn" onclick="saveSection('skills')">Save</button>
                <button class="cancel-btn" onclick="toggleEdit('skills')">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        // Handle profile image upload
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImg').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        function toggleEdit(section) {
            const editSection = document.getElementById(`${section}-edit`);
            if (section === 'personal') {
                editSection.style.display = editSection.style.display === 'none' ? 'block' : 'none';
            } else {
                editSection.classList.toggle('active');
            }
            
            // Populate current values
            if (section === 'objectives') {
                document.getElementById('objectivesInput').value = 
                    document.getElementById('objectivesDisplay').textContent;
            } else if (section === 'skills') {
                const skills = Array.from(document.querySelectorAll('.skill-tag'))
                    .map(tag => tag.textContent)
                    .join(', ');
                document.getElementById('skillsInput').value = skills;
            }
        }

        function savePersonal() {
            document.getElementById('nameDisplay').textContent = document.getElementById('nameInput').value;
            document.getElementById('ageDisplay').textContent = 'Age: ' + document.getElementById('ageInput').value;
            
            const bday = new Date(document.getElementById('bdayInput').value);
            const formattedBday = bday.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            document.getElementById('bdayDisplay').textContent = 'Birthday: ' + formattedBday;
            
            document.getElementById('addressDisplay').textContent = 'Address: ' + document.getElementById('addressInput').value;
            document.getElementById('contactDisplay').textContent = 'Contact: ' + document.getElementById('contactInput').value;
            toggleEdit('personal');
        }

        function saveSection(section) {
            switch(section) {
                case 'objectives':
                    document.getElementById('objectivesDisplay').textContent = 
                        document.getElementById('objectivesInput').value;
                    break;
                    
                case 'education':
                    const educationDisplay = document.getElementById('educationDisplay');
                    educationDisplay.innerHTML = `
                        <div class="education-item">
                            <h3>College</h3>
                            <p>${document.getElementById('collegeDegree').value}</p>
                            <p>${document.getElementById('collegeSchool').value}</p>
                            <p>${document.getElementById('collegeYears').value}</p>
                        </div>
                        <div class="education-item">
                            <h3>Senior High School</h3>
                            <p>${document.getElementById('shsTrack').value}</p>
                            <p>${document.getElementById('shsSchool').value}</p>
                            <p>${document.getElementById('shsYears').value}</p>
                        </div>
                        <div class="education-item">
                            <h3>High School</h3>
                            <p>${document.getElementById('hsSchool').value}</p>
                            <p>${document.getElementById('hsYears').value}</p>
                        </div>
                        <div class="education-item">
                            <h3>Elementary</h3>
                            <p>${document.getElementById('elemSchool').value}</p>
                            <p>${document.getElementById('elemYears').value}</p>
                        </div>
                    `;
                    break;
                    
                case 'skills':
                    const skillsContainer = document.getElementById('skillsDisplay');
                    const skillsInput = document.getElementById('skillsInput').value;
                    const skillsArray = skillsInput.split(',').map(skill => skill.trim());
                    
                    skillsContainer.innerHTML = skillsArray
                        .map(skill => `<span class="skill-tag">${skill}</span>`)
                        .join('');
                    break;
            }
            
            toggleEdit(section);
        }

        // Initialize form values when editing
        function initializeFormValues() {
            // Personal information
            document.getElementById('nameInput').value = document.getElementById('nameDisplay').textContent;
            document.getElementById('ageInput').value = document.getElementById('ageDisplay').textContent.replace('Age: ', '');
            document.getElementById('addressInput').value = document.getElementById('addressDisplay').textContent.replace('Address: ', '');
            document.getElementById('contactInput').value = document.getElementById('contactDisplay').textContent.replace('Contact: ', '');
            
            // Set birthday input to current date if not set
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('bdayInput').value = today;

            // Education
            document.getElementById('collegeDegree').value = 'BS Computer Science';
            document.getElementById('collegeSchool').value = 'University of Technology';
            document.getElementById('collegeYears').value = '2018-2022';
            
            document.getElementById('shsTrack').value = 'Science, Technology, Engineering, and Mathematics';
            document.getElementById('shsSchool').value = 'City Senior High';
            document.getElementById('shsYears').value = '2016-2018';
            
            document.getElementById('hsSchool').value = 'City High School';
            document.getElementById('hsYears').value = '2012-2016';
            
            document.getElementById('elemSchool').value = 'City Elementary School';
            document.getElementById('elemYears').value = '2006-2012';
        }

        // Call initialization when the page loads
        document.addEventListener('DOMContentLoaded', initializeFormValues);
    </script>
</body>
</html>