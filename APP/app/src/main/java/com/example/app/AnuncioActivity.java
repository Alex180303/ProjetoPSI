package com.example.app;

import android.content.Intent;
import android.os.Bundle;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class AnuncioActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_anuncio);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });

        BottomNavigationView nav = findViewById(R.id.bottom_navigation);
        nav.setSelectedItemId(R.id.nav_main);

        nav.setOnItemSelectedListener(item -> {
            abrirDestino(item.getItemId());
            return true;
        });

        // Para o item que já está marcado (Main)
        nav.setOnItemReselectedListener(item -> abrirDestino(item.getItemId()));
    }

    private void abrirDestino(int id) {
        Class<?> destino = null;
        if (id == R.id.nav_main) destino = MainActivity.class;
        else if (id == R.id.nav_publicar) destino = PublicarActivity.class;
        else if (id == R.id.nav_prefile) destino = PerfilActivity.class;

        if (destino != null) {
            startActivity(new Intent(this, destino));
            overridePendingTransition(0, 0);
            finish();
        }
    }
}