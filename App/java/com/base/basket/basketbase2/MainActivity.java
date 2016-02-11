package com.base.basket.basketbase2;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.Spinner;

import com.base.basket.basketbase2.noticias.NoticiasFragment;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {
    public static ImageView ivPatro;
    public static RelativeLayout rlPreLoad;
    public static Spinner listaEquipos;
    public static Spinner listaProvs;

    public static ArrayList<String> listClubs, listProvs;
    public static ArrayList<Integer> listIdClubs, listIdProvs;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        ivPatro=(ImageView) findViewById(R.id.imgPatroAle);
        rlPreLoad=(RelativeLayout) findViewById(R.id.preImg);
        TabLayout tabs = (TabLayout) findViewById(R.id.tabs);
        ViewPager viewPager = (ViewPager) findViewById(R.id.pager);

        viewPager.setAdapter(new SectionPagerAdapter(getSupportFragmentManager()));
        tabs.setupWithViewPager(viewPager);

        GetPatroAleatorio gpa=new GetPatroAleatorio(this);
        gpa.execute();

        listaEquipos = (Spinner) findViewById(R.id.spinnerEquipos);
        listaProvs = (Spinner) findViewById(R.id.spinnerProvs);

        listClubs=new ArrayList<>();
        listIdClubs=new ArrayList<>();
        listProvs=new ArrayList<>();
        listIdProvs=new ArrayList<>();

        if(listClubs.size()<1){
            GetProvincias gp=new GetProvincias(this);
            gp.execute("provincias?club=existe");
            GetClubs gc=new GetClubs(this);
            gc.execute("clubs?bb=1");
        }

        listaEquipos.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                if(position!=0){
                    if(position==1){
                        NoticiasFragment.setIdClub(0);
                    }
                    else{
                        NoticiasFragment.setIdClub(listIdClubs.get(position-2));
                        //PartidosFragment.setIdClub(listIdClubs.get(position-2));
                    }
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();

        switch(id){
            case R.id.action_calendar:
                Intent calendario=new Intent(getApplicationContext(), com.base.basket.basketbase2.calendario.MainActivity.class);
                startActivity(calendario);
                break;
            case R.id.action_patro:
                Intent patros=new Intent(getApplicationContext(), com.base.basket.basketbase2.patros.MainActivity.class);
                startActivity(patros);
                break;
            case R.id.action_ofertas:
                Intent ofertas=new Intent(getApplicationContext(), com.base.basket.basketbase2.ofertas.MainActivity.class);
                startActivity(ofertas);
                break;
            case R.id.action_unirse:
                /*Intent club=new Intent(this, ColaboraActivity.class);
                club.putExtra("origen", "Club");
                startActivity(club);*/
                break;
            case R.id.action_colabora:
                /*Intent colabora=new Intent(this, ColaboraActivity.class);
                colabora.putExtra("origen", "Empresa");
                startActivity(colabora);*/
                break;
        }

        return super.onOptionsItemSelected(item);
    }

    public static void setSpinnerAdapter(Context context, Spinner lista, ArrayList<String> data){
        ArrayAdapter<String> adapter = new ArrayAdapter<String>(context,
                android.R.layout.simple_spinner_item, data);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        lista.setAdapter(adapter);
    }
}
