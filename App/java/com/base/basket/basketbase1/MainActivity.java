package com.base.basket.basketbase1;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
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

import com.base.basket.basketbase1.utils.DialogInternet;
import com.base.basket.basketbase1.noticias.NoticiasFragment;
import com.base.basket.basketbase1.utils.DialogInicio;
import com.base.basket.basketbase1.utils.DialogOferta;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {
    public static ImageView ivPatro;
    public static RelativeLayout rlPreLoad;
    public static Spinner listaEquipos;
    public static Spinner listaProvs;

    public static ArrayList<String> listClubs, listProvs;
    public static ArrayList<Integer> listIdClubs, listIdProvs;

    private DialogInicio gd=new DialogInicio();
    private DialogOferta go=new DialogOferta();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if(internetConnection()){
            setContentView(R.layout.activity_main);

            checkFirstRun();

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
                gp.execute("provincias");
                GetClubs gc=new GetClubs(this);
                gc.execute("clubs");
            }

            listaEquipos.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                @Override
                public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                    if(position!=0){
                        if(position==1){
                            NoticiasFragment.setIdClub(getBaseContext(), 0);
                        }
                        else{
                            NoticiasFragment.setIdClub(getBaseContext(), listIdClubs.get(position-2));
                            PartidosFragment.setIdClub(getBaseContext(), listIdClubs.get(position-2));
                        }
                    }
                }

                @Override
                public void onNothingSelected(AdapterView<?> parent) {

                }
            });

            listaProvs.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                @Override
                public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                    if(position!=0){
                        GetClubs gc = new GetClubs(getBaseContext());
                        if(position==1) {
                            gc.execute("clubs");
                        }
                        else{
                            gc.execute("clubs?idprovincia=" + listIdProvs.get(position - 2));
                        }
                    }
                }

                @Override
                public void onNothingSelected(AdapterView<?> parent) {

                }
            });
        }
        else{
            new DialogInternet().show(getSupportFragmentManager(), "No hay conexión");
        }
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
                Intent calendario=new Intent(getApplicationContext(), com.base.basket.basketbase1.calendario.MainActivity.class);
                startActivity(calendario);
                break;
            case R.id.action_patro:
                Intent patros=new Intent(getApplicationContext(), com.base.basket.basketbase1.patros.MainActivity.class);
                startActivity(patros);
                break;
            case R.id.action_ofertas:
                Intent ofertas=new Intent(getApplicationContext(), com.base.basket.basketbase1.ofertas.MainActivity.class);
                startActivity(ofertas);
                break;
            case R.id.action_unirse:
                Intent club=new Intent(this, com.base.basket.basketbase1.colabora.MainActivity.class);
                club.putExtra("origen", "Club");
                startActivity(club);
                break;
            case R.id.action_colabora:
                Intent colabora=new Intent(this, com.base.basket.basketbase1.colabora.MainActivity.class);
                colabora.putExtra("origen", "Empresa");
                startActivity(colabora);
                break;
            case R.id.action_ayuda:
                Intent ayuda=new Intent(this, com.base.basket.basketbase1.ayuda.MainActivity.class);
                startActivity(ayuda);
                break;
        }

        return super.onOptionsItemSelected(item);
    }

    public static void setSpinnerAdapter(Context context, Spinner lista, ArrayList<String> data){
        ArrayAdapter<String> adapter = new ArrayAdapter<>(context, R.layout.spinner_item, data);
        adapter.setDropDownViewResource(R.layout.spinner_dropdown);
        lista.setAdapter(adapter);
    }

    private void checkFirstRun() {
        SharedPreferences sp=getSharedPreferences("PREFERENCE", MODE_PRIVATE);
        int firstTime=sp.getInt("Popup", 99);
        if (firstTime!=0){
            if(firstTime==99)
                gd.show(getSupportFragmentManager(), "Inicio");
            else
                go.show(getSupportFragmentManager(), "Oferta");

            getSharedPreferences("PREFERENCE", MODE_PRIVATE).edit().putInt("Popup", 0).commit();
        }
    }

    public void cerrarPopup(View view) {
        if(gd.isVisible())
            gd.dismiss();
        else{
            go.dismiss();
        }
    }

    private Boolean internetConnection(){
        ConnectivityManager connectivity = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        if (connectivity != null) {
            NetworkInfo info = connectivity.getActiveNetworkInfo();
            if (info != null) {
                if (info.isConnected()) {
                    return true;
                }
            }
        }
        return false;
    }
}
