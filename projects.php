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

        <!-- Projects placeholder -->
        <div id='projects'></div>

        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>

    <script>

    // create async function to fetch data from api 
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

    // call the function and get the data 
    // and then create the cards 
    getProjects().then(data => {
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

  </script>
