package com.example.app;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.example.app.databinding.ActivityPerfilBinding;

public class PerfilActivity extends AppCompatActivity {

    private ActivityPerfilBinding binding;
    private SharedPreferences prefs;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);

        binding = ActivityPerfilBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        ViewCompat.setOnApplyWindowInsetsListener(binding.getRoot(), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        Navegacao.configurar(this, binding.bottomNavigation, R.id.nav_prefile);

        prefs = getSharedPreferences("definicoes", MODE_PRIVATE);

        // Email recebido do login (campo não editável)
        String email = getIntent().getStringExtra("EMAIL");
        if (email != null && binding.tilEmail.getEditText() != null) {
            binding.tilEmail.getEditText().setText(email);
        }

        // Estado guardado da biometria
        binding.switchBiometria.setChecked(prefs.getBoolean("biometria", false));
        binding.switchBiometria.setOnCheckedChangeListener((buttonView, isChecked) ->
                prefs.edit().putBoolean("biometria", isChecked).apply());
    }

    public void onClickGuardar(View view) {
        binding.tilNome.setError(null);

        String nome = textoDe(binding.tilNome.getEditText());
        if (nome.isEmpty()) {
            binding.tilNome.setError("Nome obrigatório");
            return;
        }

        prefs.edit()
                .putString("nome", nome)
                .putString("contacto", textoDe(binding.tilContacto.getEditText()))
                .putString("zona", textoDe(binding.tilZona.getEditText()))
                .apply();

        binding.txtNomePerfil.setText(nome);
        Toast.makeText(this, "Alterações guardadas", Toast.LENGTH_SHORT).show();
    }

    public void onClickAlterarPassword(View view) {
        Toast.makeText(this, "Em breve", Toast.LENGTH_SHORT).show();
    }

    public void onClickTerminarSessao(View view) {
        Intent intent = new Intent(this, LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
    }

    private String textoDe(EditText campo) {
        return campo == null ? "" : campo.getText().toString().trim();
    }
}