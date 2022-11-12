<?php
// load auth Class
require_once 'class/auth.php';
require_once 'class/projects.php';
$auth = new Auth();
$projects = new Projects();
?>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <!-- Include Header-->
        <?php include('src/layout/header.php'); // File containing header code?>
        <h1>Test</h1>
        <p>Test</p>

        <input type="text" id="searchInput" placeholder="Search....">
        <button id="searchButton">Search</button>
        <!-- Projects placeholder -->
        <div id='projects'></div>

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

    // create function to display projects 
    // on the page 
    // and pass in the projects 
    // as an argument 
    // so we can display them 
    // on the page 

    // create async function to display the projects and filter them 
    // by search input 

    let searchInput = '';


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
        // return the filtered projects 
        return filteredProjects;
    }

    // call the function and get the data 
    // and then create the cards 
    function showProjects(searchInput) {


      // get projects container and clear it
      // so we can display the filtered projects 
      // on the page 
      const projectsContainer = document.getElementById('projects');
      projectsContainer.innerHTML = '';

      filterProjects(searchInput).then(data => {
          data.forEach(project => {
              const projectCard = document.createElement('div');
              projectCard.classList.add('project-card');

              // create the title
              const projectCardHeader = document.createElement('div'); 
              projectCardHeader.classList.add('project-card__header'); 
              const projectTitle = document.createElement('h2'); 
              projectTitle.classList.add('project-card__title'); 
              projectTitle.innerText = project.title; 
              projectCardHeader.appendChild(projectTitle); 
              projectCard.appendChild(projectCardHeader); 

              // create the description
              const projectCardBody = document.createElement('div'); 
              projectCardHeader.classList.add('project-card__body'); 
              const projectBody = document.createElement('p'); 
              projectBody.innerText = project.description; 
              projectCardBody.appendChild(projectBody);
              projectCard.appendChild(projectCardBody);

              // create the footer 
              const projectCardFooter = document.createElement('div');
              projectCardFooter.classList.add('project-card__footer');
              const projectFooterLink = document.createElement('a'); 
              projectFooterLink.href = '/projects/show.php?id=' + project.id; 
              projectFooterLink.innerText = 'View Project'; 
              projectCardFooter.appendChild(projectFooterLink);
              projectCard.appendChild(projectCardFooter); 
              
              
              // append the card to the projects div
              document.getElementById('projects').appendChild(projectCard);
          });
    })
    }

    showProjects('')

  </script>
