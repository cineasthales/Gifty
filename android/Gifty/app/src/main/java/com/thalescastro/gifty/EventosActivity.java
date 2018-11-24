package com.thalescastro.gifty;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.ArrayAdapter;
import android.widget.ListView;

public class EventosActivity extends AppCompatActivity implements TaskCompleted{

    private ListView listEventos;
    private int id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_eventos);

        listEventos = findViewById(R.id.listEventos);

        Intent it = getIntent();
        id = it.getIntExtra("id", -1);

        BuscaEventos buscaEventos = new BuscaEventos(this);
        buscaEventos.execute("http://thalescastro.16mb.com/gifty/ws_eventos/", String.valueOf(id));
    }

    @Override
    public void onTaskCompleteString(String result) {
        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, android.R.layout.simple_list_item_1);
        String[] partes = result.split(";");
        String data;
        if (partes[0].equals("null")) {
            adapter.add("Você ainda não está organizando eventos.");
        } else {
            for (int i = 0; i < partes.length; i += 5) {
                data = partes[i].substring(8,10) + "/" + partes[i].substring(5,7) + "/" + partes[i].substring(0,4);
                adapter.add(partes[i+2] + "\n" + data + " - " + partes[i+1].substring(0,5) +
                        "\n" + partes[i+3] + " convidados");
            }
        }
        listEventos.setAdapter(adapter);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_int, menu);
        return true;
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == R.id.mnConvites) {
            Intent it = new Intent(this, ConvitesActivity.class);
            it.putExtra("id", id);
            startActivity(it);
        }
        return true;
    }

    @Override
    public void onTaskComplete(Integer result) {
    }

    @Override
    public void onPointerCaptureChanged(boolean hasCapture) {
    }
}
