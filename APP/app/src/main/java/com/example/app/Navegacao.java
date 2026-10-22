package com.example.app;

import android.app.Activity;
import android.content.Intent;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class Navegacao {
    public static void configurar(Activity activity, BottomNavigationView nav, int itemAtual) {
        // Marcar o item do ecrã atual antes de ligar o listener
        nav.setSelectedItemId(itemAtual);

        nav.setOnItemSelectedListener(item -> {
            int id = item.getItemId();
            if (id == itemAtual) return true;

            Class<?> destino = null;
            if (id == R.id.nav_main) {
                destino = MainActivity.class;
            } else if (id == R.id.nav_publicar) {
                destino = PublicarActivity.class;
            } else if (id == R.id.nav_prefile) {
                destino = PerfilActivity.class;
            }

            if (destino != null) {
                activity.startActivity(new Intent(activity, destino));
                activity.overridePendingTransition(0, 0);
                activity.finish();
            }
            return true;
        });
    }
}
