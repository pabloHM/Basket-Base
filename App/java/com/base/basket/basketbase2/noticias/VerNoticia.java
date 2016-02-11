package com.base.basket.basketbase2.noticias;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.base.basket.basketbase2.R;

public class VerNoticia  extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ver_noticia);
        final Intent intent=getIntent();

        TextView tvTitulo=(TextView) findViewById(R.id.titNoticia);
        TextView tvSubtitulo=(TextView) findViewById(R.id.subtitNoticia);
        TextView tvCuerpo=(TextView) findViewById(R.id.cuerpoNoticia);
        ImageView ivView=(ImageView) findViewById(R.id.imgNoticia);
        RelativeLayout preView=(RelativeLayout) findViewById(R.id.preImg);

        tvTitulo.setText(intent.getStringExtra("titulo"));
        tvSubtitulo.setText(intent.getStringExtra("subtitulo"));
        tvCuerpo.setText(intent.getStringExtra("cuerpo"));

        if(!intent.getStringExtra("imagen").equals("")){
            GetImage gi=new GetImage(ivView, intent.getStringExtra("imagen"), preView);
            gi.execute();
        }
        else{
            preView.setVisibility(View.GONE);
        }
    }
}
