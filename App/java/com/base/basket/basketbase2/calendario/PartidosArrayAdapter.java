package com.base.basket.basketbase2.calendario;

import android.content.Context;
import android.graphics.Typeface;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.base.basket.basketbase2.R;
import com.base.basket.basketbase2.utils.Formats;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class PartidosArrayAdapter extends ArrayAdapter<String> {
    private final Context context;
    private final List fechas, local, visitante, ptsLocal, ptsVis;
    private List categorias=null;

    public PartidosArrayAdapter(Context context,
                                ArrayList<String> fechas,
                                ArrayList<String> local,
                                ArrayList<String> visitante,
                                ArrayList<Integer> ptsLocal,
                                ArrayList<Integer> ptsVis){
        super(context, -1, fechas);
        this.context=context;
        this.fechas=fechas;
        this.local=local;
        this.visitante=visitante;
        this.ptsLocal=ptsLocal;
        this.ptsVis=ptsVis;
    }

    public PartidosArrayAdapter(Context context,
                                ArrayList<String> fechas,
                                ArrayList<String> categorias,
                                ArrayList<String> local,
                                ArrayList<String> visitante,
                                ArrayList<Integer> ptsLocal,
                                ArrayList<Integer> ptsVis){
        super(context, -1, fechas);
        this.context=context;
        this.fechas=fechas;
        this.categorias=categorias;
        this.local=local;
        this.visitante=visitante;
        this.ptsLocal=ptsLocal;
        this.ptsVis=ptsVis;
    }

    public View getView(final int position, View convertView, ViewGroup parent){
        LayoutInflater inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View rowView=inflater.inflate(R.layout.partidos, parent, false);

        TextView fecha=(TextView) rowView.findViewById(R.id.fecha);
        RelativeLayout eqLocal=(RelativeLayout) rowView.findViewById(R.id.local);
        TextView nomLocal=(TextView) rowView.findViewById(R.id.nomLocal);
        TextView tvPtsLocal=(TextView) rowView.findViewById(R.id.ptsLocal);
        RelativeLayout eqVis=(RelativeLayout) rowView.findViewById(R.id.visitante);
        TextView nomVis=(TextView) rowView.findViewById(R.id.nomVis);
        TextView tvPtsVis=(TextView) rowView.findViewById(R.id.ptsVis);

        String fechaBD=fechas.get(position).toString();
        Date fechaFin= Formats.toDate(fechaBD);
        String diaDeSemana= Formats.getDayOfWeek(fechaFin);
        String equipoLoc=local.get(position).toString();
        String equipoVis=visitante.get(position).toString();
        String cat="";
        if(categorias!=null){
            cat=categorias.get(position)+", ";
        }

        fecha.setText(cat+diaDeSemana+" "+fechaBD);
        if(ptsLocal.get(position)!=null){
            String puntosLoc=ptsLocal.get(position).toString();
            String puntosVis=ptsVis.get(position).toString();
            tvPtsLocal.setBackgroundResource(R.color.colorMarc);
            tvPtsVis.setBackgroundResource(R.color.colorMarc);
            tvPtsLocal.setText(puntosLoc);
            tvPtsVis.setText(puntosVis);
            if(Formats.toInt(puntosLoc)>Formats.toInt(puntosVis)){
                nomLocal.setTypeface(null, Typeface.BOLD);
                tvPtsLocal.setTypeface(null, Typeface.BOLD);
            }
            else{
                nomVis.setTypeface(null, Typeface.BOLD);
                tvPtsVis.setTypeface(null, Typeface.BOLD);
            }
        }

        nomLocal.setText(equipoLoc);
        nomVis.setText(equipoVis);

        return rowView;
    }
}