const projectsUI = document.getElementById("projects-list");
const projects = document.getElementById("projects");
let projectTags = null;
let tagsLoaded = false;

function SwitchProjects(project) {
    if (!tagsLoaded) {
        projectTags = projects.getElementsByClassName("tag-button");
        tagsLoaded = true;
    }

    for(let i = 0; i < projectTags.length; i++) {
        if (projectTags[i].innerHTML == project) {
            projectTags[i].classList.add("active");
        } else {
            projectTags[i].classList.remove("active");
        }
    }
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            projectsUI.innerHTML = this.response;
        }
    };
    xmlhttp.open("GET", "php/projects.php?tag=" + project);
    xmlhttp.send();
}