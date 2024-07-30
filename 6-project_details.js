document.getElementById('return-link').addEventListener('click', function(event) {
    event.preventDefault();
    window.history.back();
});

document.addEventListener("DOMContentLoaded", function() {
    const queryParams = new URLSearchParams(window.location.search);
    const projectId = queryParams.get('id');

    if (projectId) {
        fetch(`6-project_details.php?id=${projectId}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('project_title').textContent = data.project_title;
                    document.getElementById('project_mentor').textContent = data.project_mentor;
                    document.getElementById('academic_year').textContent = data.academic_year;
                    document.getElementById('problem_statement').textContent = data.problem_statement;
                    document.getElementById('team_number').textContent = data.team_number;
                    document.getElementById('student1').textContent = `${data.student_1} ${data.usn_1}`;
                    document.getElementById('student2').textContent = `${data.student_2} ${data.usn_2}`;
                    document.getElementById('student3').textContent = `${data.student_3} ${data.usn_3}`;
                    document.getElementById('student4').textContent = `${data.student_4} ${data.usn_4}`;
                    document.getElementById('student5').textContent = `${data.student_5} ${data.usn_5}`;
                // Update the download link
                const downloadLink = document.getElementById('download_link');
                    if (data.report_file) {
                        downloadLink.href = data.report_file;
                        downloadLink.style.display = 'inline';
                    } else {
                        downloadLink.style.display = 'none';
                    }
                }
            })
        .catch(error => console.error('Error fetching project details:', error));
}
});