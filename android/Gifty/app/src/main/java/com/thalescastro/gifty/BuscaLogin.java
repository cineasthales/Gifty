package com.thalescastro.gifty;

import android.content.Context;
import android.os.AsyncTask;
import android.widget.TextView;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class BuscaLogin extends AsyncTask<String, Void, Integer> {

    private TextView txtMsg;
    private TaskCompleted mCallback;

    public BuscaLogin(TextView txtMsg, Context context) {
        this.txtMsg = txtMsg;
        this.mCallback = (TaskCompleted) context;
    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();
        txtMsg.setText("Aguarde...");
    }

    @Override
    protected void onPostExecute(Integer integer) {
        super.onPostExecute(integer);
        if (integer == -1) {
            txtMsg.setText("Sem conexão");
        } else if (integer == 0) {
            txtMsg.setText("Usuário e/ou senha incorretos");
        } else {
            txtMsg.setText("");
        }
        mCallback.onTaskComplete(integer);
    }

    @Override
    protected Integer doInBackground(String... strings) {
        int retorno = -1;

        String ws = strings[0];
        String usuario = strings[1];
        String senha = strings[2];

        try {
            URL url = new URL(ws + usuario + "/" + senha);
            HttpURLConnection urlConnection = (HttpURLConnection) url.openConnection();

            try {
                urlConnection.setDoOutput(true);
                urlConnection.setChunkedStreamingMode(0);
                urlConnection.setRequestMethod("POST");

                InputStream in = new BufferedInputStream(urlConnection.getInputStream());

                if (in != null) {
                    BufferedReader br = new BufferedReader(new InputStreamReader(in));
                    retorno = Integer.parseInt(br.readLine());
                }
            } finally {
                urlConnection.disconnect();
            }
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }

        return retorno;
    }
}
