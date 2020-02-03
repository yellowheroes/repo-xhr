# Repo-xhr
A small application that offers file upload and downloading/viewing right from your browser.
Want to select multiple files for upload, hold down CTRL while selecting files.
Uploads are executed using a chunking technique, we still need to run tests to find an optimal chunk size.
The application is password protected using .htpasswd (Apache) and .htaccess.

#### Usage
When you enter the application, you're presented with an uploader and a list view of all available titles in your repository.
You can upload a file(s), after which, the list with uploaded files is updated and shown immediately in the browser.
_(all uploads are currently stored in folder: app/repo/uploads)_

To view the contents of a file (e.g. pdf or text), just click the title and a new browser tab is opened showing the document contents.
If the title is a file that needs an application to run(e.g. Excel), the file will be downloaded automatically.
A pop-up window will ask you to select an application to run the file with - the file should open automatically in the selected app.

#### To do's
This small app was banged together fast, just to get a feel for the moving parts / potential challenges.
So, currently we just have a collection of files, without any organisation to the code (models/views/controllers):
1. refactor to OOP and autoloading to allow for easier maintenance and allow this app to be 'plugged-in' in e.g. Jimmy.
2. implement exceptions handling / error handler.

#### Ideas for improvement
1. allow for categories of file uploads
2. search functionality
3. allow for file renaming




