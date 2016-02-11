package com.base.basket.basketbase2.calendario;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.ListView;

import com.base.basket.basketbase2.R;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity{
    public static ListView lista;
    public static ArrayList<String> nombres;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_provincias);

        SharedPreferences provincias = getSharedPreferences("Provincias", 0);
        lista = (ListView) findViewById(R.id.listaProvincias);
        nombres=new ArrayList<>();

        if(provincias.getAll().size()>0){
            for(int i=0; i<provincias.getAll().size(); i++){
                nombres.add(provincias.getString("id"+i, "ERROR CACHÉ"));
            }

            initAdapter(this);
        }

        GetProvincias gp=new GetProvincias(this);
        gp.execute("provincias?club=existe");
    }

    public static void initAdapter(Context context){
        final ProvinciasArrayAdapter adapter = new ProvinciasArrayAdapter(context, nombres);
        lista.setAdapter(adapter);
    }
}
