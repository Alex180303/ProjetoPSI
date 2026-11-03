package com.example.app;

import android.app.Activity;
import android.content.Intent;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class Navegacao {

    // Versão normal (ecrãs que fazem parte da barra)
    public static void configurar(Activity activity, BottomNavigationView nav, int itemAtual) {
        configurar(activity, nav, itemAtual, true);
    }

    // Versão com 4 parâmetros (ex.: AnuncioActivity, com ignorarAtual = false)
    public static void configurar(Activity activity, BottomNavigationView nav, int itemAtual, boolean ignorarAtual) {
        // Marcar o item antes de ligar o listener
        nav.setSelectedItemId(itemAtual);

        nav.setOnItemSelectedListener(item -> {
            int id = item.getItemId();
            if (ignorarAtual && id == itemAtual) return true;

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
