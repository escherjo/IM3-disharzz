<?php
// load auth Class
require_once 'class/auth.php';
require_once 'class/projects.php';
$auth = new Auth();
$projects = new Projects();
?>
<html>
    <?php include('src/layout/head.php'); // File containing head code ?>
    <body>
        <!-- Include Header-->
        <?php include('src/layout/header.php'); // File containing header code?>
      <main class="container">
        <div class='search' id='searchSection'>
          <label for="search">Search</label>
          <div class="input__container">
            <input type="text" id="searchInput" placeholder="Search....">
          </div>
          <button id="searchButton" class="brutal-btn">Search</button>
          <div class="tags__container">
            <p>Tags</p>
            <div class="tags" id='tags'>
            </div>
             <button id='reset' class='brutal-btn'>Reset</button>
            </div>
          </div>
        <!-- Projects placeholder -->
        <div class="projects" id='projects'></div>
      </main>

        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>

    <script>

    // create async function to fetch data from api 
    // and return the data as json 
    // so we can use it in javascript 
    // to create the cards 
    // and display them on the page 
    async function getProjects() {
        const response = await fetch('http://localhost/api/projects.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Credentials': 'include'
            }
        })
        const data = await response.json();
        return data;
    }


    document.getElementById('searchButton').addEventListener('click', function () {
        // get the value of the search input 
        let searchInput = document.getElementById('searchInput').value.toLowerCase();
        showProjects(searchInput);
    })

    let searchInput = '';
    let filterTags = [];

    // eventlistener on the reset button 
    // to reset the search input and the filter tags 
    // and show all projects 
    // when the reset button is clicked 
    // and call the showProjects function 
    // to show all projects 
    document.getElementById('reset').addEventListener('click', function () {
        searchInput = '';
        filterTags = [];
        document.querySelectorAll('.tag').forEach(tag => {
          tag.classList.remove('active');
        })

        showProjects();
    })
    
    async function showTags() {
        // get all tags from api 
        const response = await fetch('http://localhost/api/tags.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Credentials': 'include'
            }
        })
        const data = await response.json();

        // loop through all tags 
        data.forEach(tag => {
            // return if tag is '' 
            if(tag === '') return;
            // create tag element 
            let tagElement = document.createElement('div');
            tagElement.classList.add('tag');
            tagElement.classList.add('brutal-btn');
            tagElement.innerText = tag;

            // add event listener to tag 
            tagElement.addEventListener('click', function () {
                // check if tag is already in filterTags 
              // if yes remove it 
              // if no add it 
              if (filterTags.includes(tag)) {
                filterTags = filterTags.filter(t => t !== tag);
                // remove active class from tag 
               tagElement.classList.remove('active');
              } else {
                filterTags.push(tag);
                // add active class to tag
                tagElement.classList.add('active');
              }
              showProjects(searchInput, filterTags);
            })

            // append tag to tags div 
            document.getElementById('tags').appendChild(tagElement);
        })
    }



    async function filterProjects(searchInput) {
        // get the projects 
        const projects = await getProjects();
        // create a new array to store the filtered projects 
        const filteredProjects = [];
        // loop through the projects 
        projects.forEach(project => {
            // check if the project title contains the search input 
            if (project.title.toLowerCase().includes(searchInput)) {
                // if it does push it to the filtered projects array 
                filteredProjects.push(project);
            }
        });

        if (filterTags.length > 0) {
          const filteredProjectsByTags = [];
          filteredProjects.forEach(project => {
            filterTags.forEach(tag => {
              if (project.tags.includes(tag)) {
                // check if project is already in filteredProjectsByTags 
              // if yes do nothing 
              // if no push it to the array 
              // so we dont get duplicates 
              if (!filteredProjectsByTags.includes(project)) {

                filteredProjectsByTags.push(project);
              }
              }
            })
          });
          return filteredProjectsByTags;
        } else {
          return filteredProjects;
        }
    }

    // function to reset filter tags 
    function resetFilterTags() {
      filterTags = [];
      // remove active class from all tags 
      showProjects(searchInput, filterTags);
    }

    // call the function and get the data 
    // and then create the cards 
    function showProjects(searchInput) {
      // check if searchInput is empty 
      // if yes set it to an empty string 
      // so we can use it in the filterProjects function 
      if (searchInput === undefined) {
        searchInput = '';
      }


      // get projects container and clear it
      // so we can display the filtered projects 
      // on the page 
      const projectsContainer = document.getElementById('projects');
      projectsContainer.innerHTML = '';

      filterProjects(searchInput).then(data => {
    if (data.length === 0) {
      projectsContainer.innerHTML = '<p>No projects found</p>';
    } else {
          data.forEach(project => {
              const projectCard = document.createElement('div');
              projectCard.classList.add('project-card');

              // create the title
              const projectCardHeader = document.createElement('div'); 
              projectCardHeader.classList.add('project-card__header'); 
              projectCardHeader.classList.add('gradient'); 
              const projectTitle = document.createElement('p'); 
              projectTitle.classList.add('project-card__title'); 
              projectTitle.innerText = project.title; 
              projectCardHeader.appendChild(projectTitle); 
              projectCard.appendChild(projectCardHeader); 

              // create the description
              const projectCardBody = document.createElement('div'); 
              projectCardBody.classList.add('project-card__body'); 
              const projectBody = document.createElement('p'); 
              projectBody.innerText = project.description; 
              projectCardBody.appendChild(projectBody);
              projectCard.appendChild(projectCardBody);
              const projectTags = document.createElement('div');
              projectTags.classList.add('project-card__tags');
              // create array of tags delemited by comma
              const tags = project.tags.split(',');
              // loop through the tags 
              tags.forEach(tag => {
                // create the tag in a <span></span>
                // and append it to the tags <div></div>
                if (tag !== '') {
                  //trim whitespace
                  const tagElement = document.createElement('span');
                  tagElement.classList.add('tag');
                  tagElement.innerText = '#' + tag.trim();
                  projectTags.appendChild(tagElement);
                }
              });
              projectCardBody.appendChild(projectTags);

              // create the footer 
              const projectCardFooter = document.createElement('div');
              projectCardFooter.classList.add('project-card__footer');
              const projectFooterLink = document.createElement('a'); 
              projectFooterLink.href = '/projects/show.php?id=' + project.id; 
              const projectFooterLinkButton = document.createElement('button');
              projectFooterLinkButton.classList.add('brutal-btn');
              
              projectFooterLink.appendChild(projectFooterLinkButton);
              projectFooterLinkButton.innerText = 'View Project';
              projectCardFooter.appendChild(projectFooterLink);
              projectCard.appendChild(projectCardFooter); 
              
              
              // append the card to the projects div
              document.getElementById('projects').appendChild(projectCard);
          });

    }
    })
    }

    //call the function to display the tags 
    showTags();

    // call the function to display the projects
    showProjects('')

  </script>
