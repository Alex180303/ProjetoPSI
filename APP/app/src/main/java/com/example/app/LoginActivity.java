package com.example.app;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;

import com.example.app.databinding.ActivityLoginBinding;

public class LoginActivity extends AppCompatActivity {

    private ActivityLoginBinding binding;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        //setContentView(R.layout.activity_login);
        //inicialização do ViewBinding
        binding = ActivityLoginBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
    }


    public void onClickLogin(View view) {
        //Acesso ao componente etEmail através do ViewBinding
        String email = "";
        String password = "";

        if (binding.etEmail.getEditText() != null) {
            email = binding.etEmail.getEditText().getText().toString();
        }
        if (binding.etPassword.getEditText() != null) {
            password = binding.etPassword.getEditText().getText().toString();
        }

        if (!isEmailValido(email)) {
            binding.etEmail.setError("Email inválido");
            return;
        }
        if (!isPasswordValido(password)) {
            binding.etPassword.setError("Password inválida");
            return;
        }
        //Toast.makeText(this, "Login efetuado com sucesso", Toast.LENGTH_SHORT).show();
        Intent intent= new Intent(this, MainActivity.class);
        intent.putExtra("EMAIL", email);
        startActivity(intent);
        finish();
    }


    public boolean isEmailValido(String email){
        if(email==null)
            return false;
        return Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }


    public boolean isPasswordValido(String pass){
        if(pass==null)
            return false;
        return pass.length()>4;
    }

    public void onClickEntrarSemLogin(View view){
        Intent intent = new Intent(this, MainActivity.class);
        startActivity(intent);
        finish();
    }
}
