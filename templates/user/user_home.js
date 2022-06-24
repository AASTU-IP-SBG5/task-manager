window.addEventListener('load', () => {
	const form = document.querySelector("#new-project-form");
	const input = document.querySelector("#new-project-input");
	const list_el = document.querySelector("#projects");

	console.log(form);
	form.addEventListener('submit', (e) => {
		e.preventDefault();

		const project = input.value;

		const project_el = document.createElement('div');
		project_el.classList.add('project');

		const project_content_el = document.createElement('div');
		project_content_el.classList.add('content');

		project_el.appendChild(project_content_el);

		const project_input_el = document.createElement('input');
		project_input_el.classList.add('text');
		project_input_el.type = 'text';
		project_input_el.value = project;
		project_input_el.setAttribute('readonly', 'readonly');

		project_content_el.appendChild(project_input_el);

		const project_actions_el = document.createElement('div');
		project_actions_el.classList.add('actions');
		
		const project_edit_el = document.createElement('button');
		project_edit_el.classList.add('edit');
		project_edit_el.innerText = 'Edit';

		const project_delete_el = document.createElement('button');
		project_delete_el.classList.add('delete');
		project_delete_el.innerText = 'Delete';

		project_actions_el.appendChild(project_edit_el);
		project_actions_el.appendChild(project_delete_el);

		project_el.appendChild(project_actions_el);

		list_el.appendChild(project_el);

		input.value = '';

		project_edit_el.addEventListener('click', (e) => {
			if (project_edit_el.innerText.toLowerCase() == "edit") {
				project_edit_el.innerText = "Save";
				project_input_el.removeAttribute("readonly");
				project_input_el.focus();
			} else {
				project_edit_el.innerText = "Edit";
				project_input_el.setAttribute("readonly", "readonly");
			}
		});

		project_delete_el.addEventListener('click', (e) => {
			list_el.removeChild(project_el);
		});
	});
});