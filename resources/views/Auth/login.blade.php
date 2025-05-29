<form action="{{ route('login') }}" method="POST">
    @csrf
    <label for="username" class="frm-label">Username</label><br>
    <input id="username" name="username" /><br>

    <label for="password" class="frm-label">Password</label><br>
    <input type="password" class="form-control" id="password" name="password" /><br>
    <br>
    <button type="submit" >Login</button>
</form>
