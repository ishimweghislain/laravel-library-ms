<!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Register - XYZ TSS</title>
       <style>
           * {
               margin: 0;
               padding: 0;
               box-sizing: border-box;
           }

           body {
               font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
               background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
               height: 130vh;
               display: flex;
               align-items: center;
               justify-content: center;
           }

           .register-container {
               background: white;
               padding: 1.5rem;
               border-radius: 10px;
               box-shadow: 0 0 20px rgba(0,0,0,0.1);
               width: 100%;
               max-width: 450px;
              
           }

           .school-name {
               text-align: center;
               color: #2c3e50;
               margin-bottom: 1.5rem;
               font-size: 1.5rem;
           }

           .form-group {
               margin-bottom: 1rem;
               display: flex;
               flex-wrap: wrap;
               gap: 1rem;
           }

           .form-group .field {
               flex: 1;
               min-width: 150px;
           }

           label {
               display: block;
               margin-bottom: 0.5rem;
               color: #2c3e50;
           }

           input, select {
               width: 100%;
               padding: 0.75rem;
               border: 1px solid #ddd;
               border-radius: 5px;
               font-size: 1rem;
           }

           input:focus, select:focus {
               outline: none;
               border-color: #3498db;
           }

           .btn-register {
               width: 100%;
               padding: 0.75rem;
               background: #3498db;
               color: white;
               border: none;
               border-radius: 5px;
               font-size: 1rem;
               cursor: pointer;
               transition: background 0.3s ease;
           }

           .btn-register:hover {
               background: #2980b9;
           }

           .error {
               color: #e74c3c;
               font-size: 0.875rem;
               margin-top: 0.5rem;
           }

           .alert-error {
               background-color: #ffebee;
               color: #e74c3c;
               padding: 0.75rem;
               border-radius: 5px;
               margin-bottom: 1.5rem;
               border-left: 4px solid #e74c3c;
           }

           .login-link {
               text-align: center;
               margin-top: 1rem;
               color: #3498db;
               text-decoration: none;
           }

           .login-link:hover {
               text-decoration: underline;
           }
       </style>
   </head>
   <body>
       <div class="register-container">
           <h1 class="school-name">XYZ TSS</h1>
           
           @if ($errors->any())
               <div class="alert-error">
                   @foreach ($errors->all() as $error)
                       {{ $error }}<br>
                   @endforeach
               </div>
           @endif
           
           @if (session('success'))
               <div class="alert-success">
                   {{ session('success') }}
               </div>
           @endif
           
           <form method="POST" action="{{ route('register.submit') }}">
               @csrf
               <div class="form-group">
                   <div class="field">
                       <label for="name">Name:</label>
                       <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                       @error('name')
                           <div class="error">{{ $message }}</div>
                       @enderror
                   </div>
               </div>
               
               <div class="form-group">
                   <div class="field">
                       <label for="role">Role:</label>
                       <select id="role" name="role" required>
                           <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                           <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                       </select>
                       @error('role')
                           <div class="error">{{ $message }}</div>
                       @enderror
                   </div>
                   <div class="field">
                       <label for="gender">Gender:</label>
                       <select id="gender" name="gender" required>
                           <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                           <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                       </select>
                       @error('gender')
                           <div class="error">{{ $message }}</div>
                       @enderror
                   </div>
               </div>
               
               <div class="form-group">
                   <div class="field">
                       <label for="district">District:</label>
                       <input type="text" id="district" name="district" value="{{ old('district') }}" required>
                       @error('district')
                           <div class="error">{{ $message }}</div>
                       @enderror
                   </div>
               </div>
               
               <div class="form-group">
                   <div class="field">
                       <label for="username">Username:</label>
                       <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                       @error('username')
                           <div class="error">{{ $message }}</div>
                       @enderror
                   </div>
                   <div class="field">
                       <label for="password">Password:</label>
                       <input type="password" id="password" name="password" required>
                       @error('password')
                           <div class="error">{{ $message }}</div>
                       @enderror
                   </div>
               </div>
               
               <div class="form-group">
                   <div class="field">
                       <label for="password_confirmation">Confirm Password:</label>
                       <input type="password" id="password_confirmation" name="password_confirmation" required>
                       @error('password_confirmation')
                           <div class="error">{{ $message }}</div>
                       @enderror
                   </div>
               </div>
               
               <button type="submit" class="btn-register" style="margin-top:20px">Register</button>
               <a href="{{ route('login') }}" class="login-link">Already have an account? Login here</a>
           </form>
       </div>
   </body>
   </html>