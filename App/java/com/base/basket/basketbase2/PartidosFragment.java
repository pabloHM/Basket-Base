package com.base.basket.basketbase2;

import android.content.Context;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;
import android.widget.RelativeLayout;

import com.base.basket.basketbase2.calendario.GetPartidos;
import com.base.basket.basketbase2.calendario.PartidosArrayAdapter;

import java.util.ArrayList;

public class PartidosFragment extends Fragment {
    private static int idclub=1;
    private static int idprov=-99;

    public static ListView lista;
    public static ArrayList<String> fechas, local, visitante, categorias;
    public static ArrayList<Integer> idpartido, ptsLoc, ptsVis;
    public static RelativeLayout preData;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rowView=inflater.inflate(R.layout.tab_marcadores, container, false);
        String peticion="marcadores";

        lista = (ListView) rowView.findViewById(R.id.listaPartidos);
        preData=(RelativeLayout) rowView.findViewById(R.id.preData);
        idpartido=new ArrayList<>();
        fechas=new ArrayList<>();
        categorias=new ArrayList<>();
        local=new ArrayList<>();
        visitante=new ArrayList<>();
        ptsLoc=new ArrayList<>();
        ptsVis=new ArrayList<>();

        if(idclub!=-99){
            peticion+="?idclub="+idclub;
        }
        else if(idprov!=-99){
            peticion+="?idprov="+idprov;
        }
        else{
            peticion+="?idclub=1";
        }

        GetPartidos gp=new GetPartidos(getContext(), 0);
        gp.execute(peticion);

        return rowView;
    }

    public static void initAdapter(Context context){
        final PartidosArrayAdapter adapter = new PartidosArrayAdapter(context, fechas, categorias, local, visitante, ptsLoc, ptsVis);
        lista.setAdapter(adapter);
        preData.setVisibility(View.GONE);
    }

    public static void setIdClub(int i) {
        idclub=i;
    }

    public static void setIdProv(int i) {
        idprov=i;
    }
}