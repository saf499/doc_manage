<?php namespace App\Controllers;
// This controller handles CRUD operations for users in the admin panel.

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function index()
    {
        // READ: Retrieve all users
        $model = new UserModel();
        $data['SPK_USERS'] = $model->findAll();

        // Load a view and pass the users data (create the view as needed)
        return view('users/index', $data);
    }

    public function create()
    {
        // Display a form to create a new user
        return view('users/create');
    }

    public function store()
    {
        // CREATE: Insert a new user into the database
        $model = new UserModel();
        $db = \Config\Database::connect();

        // Step 1: Manually get the next ID from sequence
        $query = $db->query("SELECT SPK_USERS_SEQ.NEXTVAL as ID FROM DUAL");
        $row = $query->getRowArray();
        $userID = $row['ID']; // 🔥 Use this for both insert and upload path

        $data = [
            'ID' => $userID,
            'NAME' => $this->request->getPost('NAME'),
            'EMAIL' => $this->request->getPost('EMAIL'),
            'GENDER' => $this->request->getPost('GENDER'),
            'AGE' => $this->request->getPost('AGE')
        ];

        $model->insert($data); // insert() required if u're assigning the ID urself

        $uploadPath = WRITEPATH . "uploads/users/{$userID}/";
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Handle profile picture upload
        $profilePic = $this->request->getFile('PROFILE_PIC');
        if ($profilePic && $profilePic->isValid()) {
            $picName = $profilePic->getRandomName();
            $profilePic->move($uploadPath, $picName);
            $data['PROFILE_PIC'] = $picName;
        }

        // Handle resume upload
        $resume = $this->request->getFile('RESUME');
        if ($resume && $resume->isValid()) {
            $resumeName = $resume->getRandomName();
            $resume->move($uploadPath, $resumeName);
            $data['RESUME'] = $resumeName;
        }

        $model->update($userID, $data);

        return redirect()->to('/users')->with('success', 'User saved!');
    }

    public function edit($ID)
    {
        // Retrieve the user record by its primary key for editing
        $model = new UserModel();
        $data['SPK_USERS'] = $model->find($ID);

        return view('users/edit', $data);
    }

    public function update($ID)
    {
        $model = new UserModel();

        // Base user data from form
        $data = [
            'NAME'   => $this->request->getPost('NAME'),
            'EMAIL'  => $this->request->getPost('EMAIL'),
            'GENDER' => $this->request->getPost('GENDER'),
            'AGE'    => $this->request->getPost('AGE')
        ];

        // Define upload directory based on user ID
        $uploadPath = WRITEPATH . "uploads/users/{$ID}/";
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Handle profile picture upload
        $profilePic = $this->request->getFile('profile_pic');
        if ($profilePic && $profilePic->isValid()) {
            $picName = $profilePic->getRandomName();
            $profilePic->move($uploadPath, $picName);
            $data['PROFILE_PIC'] = $picName;
        }

        // Handle resume upload
        $resume = $this->request->getFile('resume');
        if ($resume && $resume->isValid()) {
            $resumeName = $resume->getRandomName();
            $resume->move($uploadPath, $resumeName);
            $data['RESUME'] = $resumeName;
        }

        // Now update the user with all data
        $model->update($ID, $data);

        return redirect()->to('/users')->with('success', 'User updated successfully.');
    }

    public function delete($ID)
    {
        // DELETE: Remove the user record with the specified id
        $model = new UserModel();
        $model->delete($ID);

        return redirect()->to('/users');
    }
}

