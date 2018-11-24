package com.thalescastro.gifty;

import android.content.Context;
import android.os.AsyncTask;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class BuscaConvites extends AsyncTask<String, Void, String> {

    private TaskCompleted mCallback;

    public BuscaConvites(Context context) {
        this.mCallback = (TaskCompleted) context;
    }

    @Override
    protected void onPostExecute(String s) {
        super.onPostExecute(s);
        mCallback.onTaskCompleteString(s);
    }

    @Override
    protected String doInBackground(String... strings) {
        HttpURLConnection httpURL=null;
        String convites="";
        try {
            URL url = new URL(strings[0] + '/' + strings[1]);
            httpURL = (HttpURLConnection) url.openConnection();
            int code = httpURL.getResponseCode();
            if (code == 200) {
                InputStream in = new BufferedInputStream(httpURL.getInputStream());
                if (in != null) {
                    BufferedReader br = new BufferedReader(new InputStreamReader(in));
                    convites = br.readLine();
                }
                in.close();
            }
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return convites;
    }

}

