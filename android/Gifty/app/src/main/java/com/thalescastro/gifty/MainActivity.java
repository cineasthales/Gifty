package com.thalescastro.gifty;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity implements TaskCompleted, View.OnClickListener {

    private EditText edtUsuario;
    private EditText edtSenha;
    private Button btEntrar;
    private TextView txtMsg;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        edtUsuario = findViewById(R.id.edtUsuario);
        edtSenha = findViewById(R.id.edtSenha);
        btEntrar = findViewById(R.id.btEntrar);
        txtMsg = findViewById(R.id.txtMsg);

        btEntrar.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        if (v.getId() == R.id.btEntrar) {
            String usuario = edtUsuario.getText().toString();
            String senha = edtSenha.getText().toString();

            if (usuario.trim().isEmpty() || senha.trim().isEmpty()) {
                Toast.makeText(this, "Preencha todos os dados", Toast.LENGTH_LONG).show();
                edtUsuario.requestFocus();
                return;
            }

            BuscaLogin buscaLogin = new BuscaLogin(txtMsg, this);
            buscaLogin.execute("http://thalescastro.16mb.com/gifty/ws_login/", usuario, senha);
        }
    }

    @Override
    public void onTaskComplete(Integer result) {
        if (result > 0) {
            Intent it = new Intent(this, ConvitesActivity.class);
            it.putExtra("id", result);
            startActivity(it);
        }
    }

    @Override
    public void onTaskCompleteString(String result) {
    }

    @Override
    public void onPointerCaptureChanged(boolean hasCapture) {
    }
}

