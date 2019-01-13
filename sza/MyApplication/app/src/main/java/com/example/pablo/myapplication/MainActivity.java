package com.example.pablo.myapplication;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button button = (Button) findViewById(R.id.apeseta);
        Button button2 = (Button) findViewById(R.id.aeuro);
        final EditText euro = (EditText) findViewById(R.id.euro);
        final EditText peseta = (EditText) findViewById(R.id.peseta);

        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String seuros = euro.getText().toString();
                float euros = Float.parseFloat(seuros);
                float pesetas = euros * 166;
                String spesetas = String.format("%f", pesetas);
                peseta.setText(spesetas);

            }
        });

        button2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String spesetas = peseta.getText().toString();
                float pesetas = Float.parseFloat(spesetas);
                float euros = pesetas / 166f;
                String seuros = String.format("%f", euros);
                peseta.setText(seuros);

            }
        });


    }
}
