package com.base.basket.basketbase2.calendario;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.ListView;

import com.base.basket.basketbase2.R;

import java.util.ArrayList;

public class PartidosActivity extends AppCompatActivity{
    public static ListView lista;
    public static ArrayList<String> fechas, local, visitante;
    public static ArrayList<Integer> idpartido, ptsLoc, ptsVis;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_partidos);

        lista = (ListView) findViewById(R.id.listaPartidos);
        idpartido=new ArrayList<>();
        fechas=new ArrayList<>();
        local=new ArrayList<>();
        visitante=new ArrayList<>();
        ptsLoc=new ArrayList<>();
        ptsVis=new ArrayList<>();

        GetPartidos gp=new GetPartidos(this);
        gp.execute("marcadores?idequipo="+getIntent().getIntExtra("idEquipo", -99));
    }

    public static void initAdapter(Context context){
        final PartidosArrayAdapter adapter = new PartidosArrayAdapter(context, fechas, local, visitante, ptsLoc, ptsVis);
        lista.setAdapter(adapter);
    }
}